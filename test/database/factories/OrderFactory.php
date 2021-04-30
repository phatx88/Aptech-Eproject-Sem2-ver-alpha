<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;
use App\Models\Order;
use App\Models\ShippingStatus;
use App\Models\Staff;
use App\Models\User;
use App\Models\Ward;
use Carbon\Carbon;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $id = $this->faker->boolean(50) ? User::where('is_staff', 0)->whereNotNull('ward_id')->pluck('id')->random() : null;
        if ($id == null) {
            $ward = Ward::get()->random();
            $ward_id = $ward->id;
            $province_id = $ward->district->province->id;
            DB::table('province')->where('id', $province_id)->increment('order_count');
            return [
                'created_date' => $date = $this->faker->dateTimeBetween('-1 year -6 months', '+4 weeks'),
                'order_status_id' => ShippingStatus::find(5),
                'customer_id' => null,
                'shipping_fullname' => $this->faker->name,
                'shipping_email' => $this->faker->safeEmail,
                'shipping_mobile' => $this->faker->e164PhoneNumber(),
                'shipping_housenumber_street' => $this->faker->streetAddress,
                'shipping_ward_id' => $ward_id,
                'payment_method' => $this->faker->numberBetween(0, 1),
                'shipping_fee' => $this->faker->numberBetween(10, 25),
                'delivered_date' => Carbon::parse($date)->addDays(4),
                'staff_id' => Staff::get()->pluck('id')->random(),
            ];
        } else {
            $ward_id = User::where('id', $id)->first()->ward_id;
            $ward = Ward::where('id', $ward_id)->first();
            $province_id = $ward->district->province->id;
            DB::table('province')->where('id', $province_id)->increment('order_count');
            return [
                'created_date' => $date = $this->faker->dateTimeBetween('-1 year -6 months', '+4 weeks'),
                'order_status_id' => ShippingStatus::find(5),
                'customer_id' => $id,
                'shipping_fullname' => User::where('id', $id)->first()->name,
                'shipping_email' => User::where('id', $id)->first()->email,
                'shipping_mobile' => User::where('id', $id)->first()->mobile,
                'shipping_housenumber_street' => User::where('id', $id)->first()->housenumber_street,
                'shipping_ward_id' => $ward_id,
                'payment_method' => $this->faker->numberBetween(0, 1),
                'shipping_fee' => $this->faker->numberBetween(10, 25),
                'delivered_date' => Carbon::parse($date)->addDays(4),
                'staff_id' => Staff::get()->pluck('id')->random(),
            ];
        }
       
    }
}

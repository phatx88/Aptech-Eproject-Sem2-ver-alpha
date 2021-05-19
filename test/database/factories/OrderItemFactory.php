<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class OrderItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OrderItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $product_id = Product::whereBetween('id' , [6,12])->pluck('id')->random();
        // $product_id = Product::all()->pluck('id')->random();
        $qty = $this->faker->numberBetween(1, 3);
        $unit_price = Product::where('id' , $product_id)->value('sale_price');
        $total_price = $unit_price * $qty;
        return [
            'order_id' => Order::all()->pluck('id')->random(),
            'product_id' => $product_id,
            'qty' => $qty,
            'unit_price' => $unit_price,
            'total_price' => $total_price,
        ];
    }
}

<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Ward;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'email_verified_at' => $this->faker->dateTimeBetween('-1 year -6 months', '+1 month'),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'created_at' => $this->faker->dateTimeBetween('-1 year -6 months', '+1 month'),
            'updated_at' => now(),
            'mobile' => $this->faker->e164PhoneNumber(),
            'housenumber_street' => $this->faker->streetAddress,
            'ward_id' => Ward::get()->pluck('id')->random(),
            'last_login_at' => $this->faker->dateTimeBetween('-1 year -6 months', '+1 month')
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

     /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function randomLogin()
    {
        return $this->state(function (array $attributes) {
            return [
                'last_login_at' => $this->faker->dateTimeBetween('-1 year -6 months', '+1 month'),
            ];
        });
    }
}

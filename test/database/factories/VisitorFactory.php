<?php

namespace Database\Factories;

use App\Models\Visitor;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class VisitorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Visitor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'hits' => $this->faker->numberBetween(1, 10),
            'ip' => $this->faker->unique()->ipv4,
            'date_visited' => $this->faker->dateTimeBetween('-7 days' , now()),
            'user_id' => $this->faker->boolean(25) ? User::get()->pluck('id')->random() : null,
        ];
    }
}

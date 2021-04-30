<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Product;

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
        return [
            'order_id' => factory(Order::class),
            'product_id' => factory(Product::class),
            'qty' => $this->faker->numberBetween(1, 20),
            'unit_price' => function (array $orderItem) {
                return Product::find($orderItem['product_id'])->sale_price;
            },
            'Total_price' => $this->faker->numberBetween(100, 1000),
        ];
    }
}

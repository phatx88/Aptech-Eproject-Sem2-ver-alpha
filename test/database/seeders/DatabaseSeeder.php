<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // User::factory(10)->create();
        // Order::factory(10)->create();
        
        // Magic method - belong to relationship
        // $user =  User::factory(2)->create();
        // Order::factory()
        //     ->count(3)
        //     ->for($user)
        //     ->create();

        // Magic method - has many
        Order::factory()
            ->has(OrderItem::factory()->count(3))
            ->create();
        
    }
}

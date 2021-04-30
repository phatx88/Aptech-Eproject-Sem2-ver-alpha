<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Order;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $user =  User::factory(5)->create();
        Order::factory(100)->create();
        // Order::factory()
        //     ->count(3)
        //     ->for($user)
        //     ->create();
    }
}

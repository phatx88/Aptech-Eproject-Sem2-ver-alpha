<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Order;
use App\Models\OrderItem;
use Carbon\Carbon;

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
        
        // CREATE ORDER WITH RANDOM SPECIFIC USER 
        // Magic method - belong to relationship
        // $user =  User::all()->random();
        // Order::factory()
        //     ->count(3)
        //     ->for($user)
        //     ->has(OrderItem::factory()->count(1))
        //     ->create();

        // CREATE ORDER WITH RANDOM USERS 
        // Magic method - has many 
        // Order::factory()
        //     ->count(1000)
        //     ->has(OrderItem::factory()->count(1))
        //     ->create();
        
        //User->Order->OrderItem
        // $user =  User::factory()->create();
        // Order::factory()
        // ->count(1000)
        // ->for(User::factory())
        // ->has(OrderItem::factory()->count(1))
        // ->create();

        //RANDOM LOGIN AT FOR ALL USERS 
        // $users = User::all();
        // foreach ($users as $user) {
        //     $user->update([
        //         'last_login_at' => Carbon::now()->subDays(rand(1, 365))
        //     ]);
        // }
    }
}

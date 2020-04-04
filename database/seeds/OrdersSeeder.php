<?php

use Illuminate\Database\Seeder;

class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $orders = factory('App\Order',3)->create(['user_id' => \App\User::all()->random(1)->first()->id]);
        factory('App\OrderProduct',10)->create(['order_id' => $orders->random(1)->first()->id]);
    }
}

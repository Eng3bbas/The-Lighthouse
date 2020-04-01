<?php

/** @var Factory $factory */

use App\Order;
use App\OrderProduct;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(OrderProduct::class, function (Faker $faker) {
    return [
        'order_id' => (Order::latest()->first() ?? \factory(Order::class)->create())->id,
        'product_id' => ( \App\Product::count() > 0 ?\App\Product::inRandomOrder()->first() : factory('App\Product')->create())->id,
        'quantity' => $faker->randomNumber(2)
    ];
});

<?php

/** @var Factory $factory */

use App\Order;
use App\OrderProduct;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(OrderProduct::class, function (Faker $faker) {
    return [
        'order_id' => app()->runningUnitTests() ? 1 : factory(Order::class)->create()->id,
        'product_id' => factory('App\Product')->create([
            'user_id' => app()->runningUnitTests() ? 1 : (factory('App\User')->create())->id,
            'category_id' => (factory('App\Category')->create())->id,
        ])->id,
        'quantity' => $faker->randomNumber(2)
    ];
});

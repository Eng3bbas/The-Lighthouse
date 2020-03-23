<?php

/** @var Factory $factory */

use App\Order;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id' => app()->runningUnitTests()
            ?  1
            : factory(User::class)->create()->id,
        'address' => $faker->address,
        'notes' => $faker->paragraph,
        'total_money' => $faker->randomNumber(4)
    ];
});

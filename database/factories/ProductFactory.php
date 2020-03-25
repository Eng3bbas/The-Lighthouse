<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => $faker->numberBetween(1,9999),
        'image' => "products/".$faker->image('storage/app/public/products',$faker->randomNumber(3),$faker->randomNumber(3),null,false,true),
        'user_id' => factory('App\User')->create(['role' => 1])->id,
        'category_id' => factory('App\Category')->create()->id
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use App\Product;
use App\User;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'price' => $faker->numberBetween(1,9999),
        'image' => app()->runningUnitTests() ? null :"products/".$faker->image('storage/app/public/products',$faker->randomNumber(3),$faker->randomNumber(3),'food',true,true),
        'user_id' => (User::firstWhere('role',1) ?? factory('App\User')->create(['role' => 1]))->id,
        'category_id' => (Category::first() ?? factory('App\Category')->create())->id
    ];
});

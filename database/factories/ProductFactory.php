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
        'image' => app()->runningUnitTests() ? null :"products/".$faker->image('storage/app/public/products',$faker->numberBetween(200,700),$faker->numberBetween(200,700),null,false,true),
        'user_id' => (User::firstWhere('role',1) ?? factory('App\User')->create(['role' => 1]))->id,
        'category_id' => Category::count() > 0 ? Category::inRandomOrder()->first()->id : factory(Category::class)->create()->id
    ];
});

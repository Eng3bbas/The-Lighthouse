<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {

    return [
        'name' => $faker->name,
        'image' => app()->runningUnitTests() ? null: "categories/". $faker->image('storage/app/public/categories',$faker->numberBetween(100,900),$faker->numberBetween(100,900),null,false)
    ];
});

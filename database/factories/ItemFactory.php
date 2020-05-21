<?php

use App\Item;
use Faker\Generator as Faker;

$factory->define(Item::class, function (Faker $faker) {
    return [
    	'name' => $faker->firstName(),
    	'type' => $faker->word,
    	'description' => $faker->sentence(),
    	'price' => $faker->numberBetween(10000, 200000),
    	'quantity' => $faker->numberBetween(10, 100),
    ];
});

<?php

use App\Box;
use Faker\Generator as Faker;

$factory->define(Box::class, function (Faker $faker) {
    return [
    	'name' => $faker->firstName(),
    	'description' => $faker->sentence(),
    	'price' => $faker->numberBetween(50000, 500000),
    	'quantity' => $faker->numberBetween(1, 50),
    ];
});

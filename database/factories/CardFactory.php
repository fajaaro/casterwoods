<?php

use App\Card;
use Faker\Generator as Faker;

$factory->define(Card::class, function (Faker $faker) {
    return [
    	'name' => $faker->firstName(),
    	'description' => $faker->sentence(),
    	'price' => $faker->numberBetween(30000, 300000),
    	'quantity' => $faker->numberBetween(5, 59),        
    ];
});

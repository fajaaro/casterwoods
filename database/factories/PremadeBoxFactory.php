<?php


use App\PremadeBox;
use Faker\Generator as Faker;

$factory->define(PremadeBox::class, function (Faker $faker) {
    return [
    	'name' => $faker->firstName(),
    	'type' => $faker->word,
    	'description' => $faker->sentence(),
    	'price' => $faker->numberBetween(75000, 1000000),
    	'quantity' => $faker->numberBetween(1, 50),    	
    ];
});

<?php

use App\ItemTransaction;
use Faker\Generator as Faker;

$factory->define(ItemTransaction::class, function (Faker $faker) {
    return [
    	'quantity' => $faker->numberBetween(1, 10),
    ];
});

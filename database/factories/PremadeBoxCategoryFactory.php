<?php

use App\PremadeBoxCategory;
use Faker\Generator as Faker;

$factory->define(PremadeBoxCategory::class, function (Faker $faker) {
    return [
        'name' => $faker->words($faker->numberBetween(1, 3), true),
    ];
});

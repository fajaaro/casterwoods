<?php

use App\Transaction;
use Faker\Generator as Faker;

$factory->define(Transaction::class, function (Faker $faker) {
    return [
		'card_content' => $faker->sentence(),
		'additional_note' => $faker->sentence(),
		'receiver_name' => $faker->firstName(),
		'receiver_address' => $faker->address,
		'receiver_contact' => $faker->freeEmail,
    ];
});

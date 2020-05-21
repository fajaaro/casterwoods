<?php

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        'remember_token' => Str::random(10),
    ];
});

$factory->state(User::class, 'user-fajar', function (Faker $faker) {
    return [
        'name' => 'Fajar Hamdani',
        'email' => 'fajarhamdani70@gmail.com',
        'email_verified_at' => now(),
        'password' => Hash::make('fajar123'), 
        'remember_token' => Str::random(10),
    ];
});

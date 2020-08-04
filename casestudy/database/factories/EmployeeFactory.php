<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Employee;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Employee::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        'remember_token' => Str::random(10),
        'avatar' => $faker->imageUrl($width = 200, $height = 200),
        'role' => $faker->numberBetween($min=1, $max=2),
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\UserInformation;
use Faker\Generator as Faker;

$factory->define(UserInformation::class, function (Faker $faker) {
    return [
        'fullName' => $faker->firstNameMale,
        'phone' => 1234567890,
        'user_id' => $faker->numberBetween($min = 1, $max = 5),

    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\UserInformation;
use Faker\Generator as Faker;

$factory->define(UserInformation::class, function (Faker $faker) {
    return [
        'fullName' => $faker->firstNameMale,
        'phone' => 1234567890,
        'address' => 'ha noi - viet nam',
        'gender' => 'male',
        'user_id' => $faker->numberBetween($min = 1, $max = 5),
        'avatar' => $faker->imageUrl($width = 200, $height = 200),
        'role' => $faker->numberBetween($min=0, $max=1),
        

    ];
});

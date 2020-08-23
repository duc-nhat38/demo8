<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\HomeInformation;
use Faker\Generator as Faker;

$factory->define(HomeInformation::class, function (Faker $faker) {
    return [
        'area' => $faker->numberBetween($min = 100, $max = 300),
        'title' => $faker->realText($maxNbChars = 15, $indexSize = 2),
        'description' => $faker->realText($maxNbChars = 200, $indexSize = 2),
        'house_id' => $faker->numberBetween($min=1, $max=20),
    ];
});

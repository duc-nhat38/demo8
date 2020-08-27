<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */


use App\Models\HomePhoto;
use Faker\Generator as Faker;

$factory->define(HomePhoto::class, function (Faker $faker) {
    return [
        'photoAddress' => $faker->imageUrl($width = 500, $height = 300),
        'house_id' => $faker->numberBetween($min=1, $max=20),
    ];
});

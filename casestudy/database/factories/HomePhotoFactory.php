<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\HomePhoto;
use Faker\Generator as Faker;

$factory->define(HomePhoto::class, function (Faker $faker) {
    return [
        'title' => $faker->realText($maxNbChars = 15, $indexSize = 2),
        'photoAddress' => $faker->imageUrl($width = 500, $height = 300),
    ];
});

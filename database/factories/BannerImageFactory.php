<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\BannerImage;
use Faker\Generator as Faker;

$factory->define(BannerImage::class, function (Faker $faker) {
    return [
        'title' => $faker->text($maxNbChars = 20),
        'imageAddress' => $faker->imageUrl($width = 1000, $height = 720),
        'user_id' => $faker->numberBetween($min = 1, $max = 5),
        'partner' => $faker->name($gender = 'male'|'female'),
        'show' => '1',
        'expirationDate' => '2020/09/01'
    ];
});

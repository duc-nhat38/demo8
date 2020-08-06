<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\BannerImage;
use Faker\Generator as Faker;

$factory->define(BannerImage::class, function (Faker $faker) {
    return [
        'title' => $faker->text($maxNbChars = 20),
        'imageAddress' => $faker->imageUrl($width = 1000, $height = 720),
        'employee_id' => $faker->numberBetween($min = 1, $max = 5),
        'renter' => $faker->name($gender = 'male'|'female'),
        'show' => '1'
    ];
});

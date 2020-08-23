<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\District;
use Faker\Generator as Faker;

$factory->define(District::class, function (Faker $faker) {
    return [
        'district' => $faker->city,
        'address_id' => $faker->numberBetween($min = 1, $max = 5),
    ];
});

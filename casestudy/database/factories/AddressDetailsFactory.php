<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\AddressDetails;
use Faker\Generator as Faker;

$factory->define(AddressDetails::class, function (Faker $faker) {
    return [
        'address' => $faker->city,
        'address_id' => $faker->numberBetween($min = 1, $max = 5),
    ];
});

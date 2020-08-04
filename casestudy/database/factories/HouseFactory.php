<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\House;
use Faker\Generator as Faker;

$factory->define(House::class, function (Faker $faker) {
    return [
        'user_id'=> $faker->numberBetween($min=1, $max=5),
        'house_type_id' => $faker->numberBetween($min=1, $max=3),
        'address_details_id' => $faker->numberBetween($min=1, $max=20),
        'home_information_id' => $faker->numberBetween($min=1, $max=20),
        'business_type_id' => $faker->numberBetween($min=1, $max=2),
        'price' => $faker->numberBetween($min=1000, $max=2000),
        'expired' => '0'
    ];
});

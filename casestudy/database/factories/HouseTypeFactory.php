<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\HouseType;
use Faker\Generator as Faker;

$factory->define(HouseType::class, function (Faker $faker) {
    return [
        'typeName' => $faker->company,
    ];
});

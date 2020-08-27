<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\BusinessType;
use Faker\Generator as Faker;

$factory->define(BusinessType::class, function (Faker $faker) {
    return [
        'typeName' => $faker->unique()->company,
    ];
});

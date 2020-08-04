<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
       'user_id' => $faker->numberBetween($min = 1, $max = 5),
       'house_id' => $faker->numberBetween($min = 1, $max = 20),
       'content' => $faker->realText($maxNbChars = 50, $indexSize = 2),       
    ];
});

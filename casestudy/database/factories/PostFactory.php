<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\Post;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'employee_id' => $faker->numberBetween($min=1, $max=5),
        'title' => $faker->realText($maxNbChars = 15, $indexSize = 2),
        'content' => $faker->realText($maxNbChars = 200, $indexSize = 2)

    ];
});

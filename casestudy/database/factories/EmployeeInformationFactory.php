<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Models\EmployeeInformation;
use Faker\Generator as Faker;

$factory->define(EmployeeInformation::class, function (Faker $faker) {
    return [
        'employeeCode' => $faker->numberBetween($min = 1, $max = 100),
        'fullName' => $faker->firstNameMale,
        'address' => $faker->streetAddress,
        'phone' => $faker->e164PhoneNumber,
        'work' => $faker->jobTitle, 
        'employee_id' => $faker->numberBetween($min = 1, $max = 5)
    ];
});

<?php

use App\Models\Employee\Employee;
use App\Models\Employee\Name;
use Faker\Generator as Faker;

$factory->define(Name::class, function (Faker $faker) {
    return [
        'employee_id' => rand(1, Employee::count()),
        'first' => $faker->firstName,
        'last' => $faker->lastName,
        'middle' => $faker->lastName,
    ];
});

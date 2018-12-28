<?php

use App\Models\Employee\Employee;
use App\Models\GEO\Department;
use Faker\Generator as Faker;

$factory->define(Employee::class, function (Faker $faker) {
    $gender = config('gender');
    return [
        'department_id' => rand(1, Department::count()),
        'email' => $faker->safeEmail,
        //Salary increase for specific employee
        'salary' => $faker->boolean($chanceOfGettingTrue = 5) ? (mt_rand(ceil(50/50) , floor(1000/50))*50) : 0,
        'employment_date' => $faker->dateTimeBetween($startDate = '-20 years', $endDate = 'now'),
        'gender' => $gender[array_rand($gender)],
    ];
});

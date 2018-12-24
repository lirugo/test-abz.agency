<?php

use App\Models\User\Salary;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(Salary::class, function (Faker $faker) {
    return [
        'salary' => mt_rand(ceil(1000/100) , floor(20000/100))*100,
        'currency' => 'USD'
    ];
});

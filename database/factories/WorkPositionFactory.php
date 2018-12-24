<?php

use App\Models\User\WorkPosition;
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

$factory->define(WorkPosition::class, function (Faker $faker) {
    return [
        'position_id' => rand(1, count(config('workposition')))
    ];
});

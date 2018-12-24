<?php

use App\Models\User\Boss;
use App\Models\User\User;
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

$factory->define(Boss::class, function (Faker $faker) {
    return [
        'boss_id' => rand(1, User::count())
    ];
});

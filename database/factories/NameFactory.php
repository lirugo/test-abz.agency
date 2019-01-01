<?php

use App\Models\Employee\Name;
use Faker\Generator as Faker;

$factory->define(Name::class, function (Faker $faker) {
    return [
        'first' => $faker->firstName,
        'last' => $faker->lastName,
        'middle' => $faker->lastName,
    ];
});

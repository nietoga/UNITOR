<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Period;
use App\User;
use Faker\Generator as Faker;

$factory->define(Period::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'name' => $faker->year(),
    ];
});

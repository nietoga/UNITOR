<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Course;
use App\Period;
use Faker\Generator as Faker;

$factory->define(Course::class, function (Faker $faker) {
    return [
        'period_id' => Period::all()->random()->getId(),
        'name' => $faker->colorName(),
    ];
});

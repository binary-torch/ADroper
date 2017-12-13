<?php

use Faker\Generator as Faker;

$factory->define(App\Course::class, function (Faker $faker) {
    return [
        "college_id" => \App\College::inRandomOrder()->first()->id,
        "name" => $faker->unique()->colorName,
        "code" => $faker->unique()->languageCode,
    ];
});
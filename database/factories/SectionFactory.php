<?php

use Faker\Generator as Faker;

$factory->define(App\Section::class, function (Faker $faker) {
    return [
        "course_id" => \App\Course::inRandomOrder()->first()->id,
        "lecturer_id" => \App\User::inRandomOrder()->first()->id,
        "number" => $faker->numerify("#"),
        "date" => $faker->date(),
    ];
});
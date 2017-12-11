<?php

use Faker\Generator as Faker;

$factory->define(App\College::class, function (Faker $faker) {
    return [
        "name" => $faker->unique()->colorName
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\TypeUnit;
use Faker\Generator as Faker;

$factory->define(TypeUnit::class, function (Faker $faker) {
    return [
        'type_unit' => $faker->randomElement(['metro','kilogramo','kilolitro','metro cubico']),
        'description' => $faker->text
    ];
});

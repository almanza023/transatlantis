<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\TypeProvider;
use Faker\Generator as Faker;

$factory->define(TypeProvider::class, function (Faker $faker) {
    return [
        'type_provider' => $faker->randomElement(['natural', 'juridico']),
        'description' => $faker->text
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\TypeCustomer;
use Faker\Generator as Faker;

$factory->define(TypeCustomer::class, function (Faker $faker) {
    return [
        'type_customer' => $faker->randomElement(['natural', 'juridico']),
        'description' => $faker->text
    ];
});

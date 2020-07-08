<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\TypePayment;
use Faker\Generator as Faker;

$factory->define(TypePayment::class, function (Faker $faker) {
    return [
        'type_payment' => $faker->randomElement(['credito', 'contado']),
        'description' => 'Descripcion de tipos de pagos'
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\TimePayment;
use Faker\Generator as Faker;

$factory->define(TimePayment::class, function (Faker $faker) {
    return [
        'time_payment' => $faker->randomDigit,
        'description' => 'Descripcion de tiempos de pagos'
    ];
});

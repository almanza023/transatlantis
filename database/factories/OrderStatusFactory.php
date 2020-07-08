<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OrderStatus;
use Faker\Generator as Faker;

$factory->define(OrderStatus::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['No Aprobado', 'Aprobado', 'Rechazado', 'Despacho', 'Compra', 'Entregado']),
        'order_by' => rand(1, 7),
        'description' => $faker->sentence
    ];
});

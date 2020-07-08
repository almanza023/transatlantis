<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\VehicleStatus;
use Faker\Generator as Faker;

$factory->define(VehicleStatus::class, function (Faker $faker) {
    return [
        'name' => $faker->randomElement(['Disponible', 'Reparacion', 'Sin Funcionamiento', 'Ocupado']),
        'order_by' => rand(1, 4)
    ];
});

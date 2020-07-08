<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Vehicle;
use Faker\Generator as Faker;

$factory->define(Vehicle::class, function (Faker $faker) {
    return [
        'placa' => $faker->unique()->domainName,
        'model' => rand(2000,2020),
        'type_vehicle' => $faker->randomElement(['Carga Pesada', 'Carga Mediana', 'Carga Ligera']),
        'brand' => $faker->word,
        'volume' => rand(1000, 5000),
        'capacity' => rand(1000, 5000)
    ];
});

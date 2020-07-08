<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Departament;
use App\Models\Municipality;
use Faker\Generator as Faker;

$factory->define(Municipality::class, function (Faker $faker) {
    return [
        'id_departament' => Departament::inRandomOrder()->value('id_departament'),
        'name_municipality' => $faker->city
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Domicile;
use App\Models\Municipality;
use Faker\Generator as Faker;

$factory->define(Domicile::class, function (Faker $faker) {
    return [
        'id_municipality' => Municipality::inRandomOrder()->value('id_municipality'),
        'address' => $faker->address,
        'additional' => $faker->sentence,
        'contact_number' => $faker->phoneNumber
    ];
});

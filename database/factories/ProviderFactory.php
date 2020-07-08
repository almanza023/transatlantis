<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Municipality;
use App\Models\Provider;
use App\Models\TypeProvider;
use Faker\Generator as Faker;

$factory->define(Provider::class, function (Faker $faker) {
    return [
        'nit' => $faker->unique()->numberBetween($min = 1000000000, $max = 2000000000),
        'id_type_provider' => TypeProvider::inRandomOrder()->value('id_type_provider'),
        'id_municipality' => Municipality::inRandomOrder()->value('id_municipality'),
        'full_name' => $faker->company,
        'first_name' => $faker->name,
        'last_name' => $faker->lastName,
        'address' => $faker->address,
        'email' => $faker->safeEmail,
        'contact_number' => $faker->phoneNumber,
        'provider_status' => 1
    ];
});

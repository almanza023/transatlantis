<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Driver;
use Faker\Generator as Faker;

$factory->define(Driver::class, function (Faker $faker) {
    return [
        'nid_driver' => $faker->unique()->numberBetween($min = 1000000000, $max = 2000000000),
        'first_name' => $faker->name,
        'last_name' => $faker->lastName,
        'address' => $faker->address,
        'email' => $faker->safeEmail,
        'contact_number' => $faker->phoneNumber,
        'contact_number_second' => $faker->phoneNumber,
        'blood_type' => $faker->randomElement(['A+', 'O+','O-', 'B+']),
        'date_birth' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'medical_observation' => $faker->text,
        'place_care' => $faker->country,
        'arl' => $faker->uuid,
        'driver_status' => 1
    ];
});

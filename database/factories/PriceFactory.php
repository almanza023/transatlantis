<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Price;
use Faker\Generator as Faker;

$factory->define(Price::class, function (Faker $faker) {
    return [
        'effective_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'expiration_date' => null,
        'price' => $faker->numberBetween($min = 1000, $max = 9000),
        'price_status' => 1
    ];
});

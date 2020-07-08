<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\OrderDetail;
use App\Models\Product;
use Faker\Generator as Faker;

$factory->define(OrderDetail::class, function (Faker $faker) {
    return [
        'id_product' => Product::inRandomOrder()->value('id_product'),
        'amount' => $faker->randomDigit,
        'unit_price' => $faker->numberBetween($min = 1000, $max = 9000)
    ];
});

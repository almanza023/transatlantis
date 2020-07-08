<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\CustomerDomicile;
use App\Models\Order;
use App\Models\TimePayment;
use App\Models\TypePayment;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'id_customer_domicile' => CustomerDomicile::inRandomOrder()->value('id_customer_domicile'),
        'id_type_payment' => TypePayment::inRandomOrder()->value('id_type_payment'),
        'id_time_payment' => TimePayment::inRandomOrder()->value('id_time_payment'),
        'date_order' => $faker->dateTimeBetween($startDate = '-2 years', $endDate = 'now', $timezone = 'America/Bogota'),
        'priority' => rand(1, 10)
    ];
});

<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Customer;
use App\Models\TypeCustomer;
use Faker\Generator as Faker;

$factory->define(Customer::class, function (Faker $faker) {
    return [
        'nid' => $faker->unique()->numberBetween($min = 1000000000, $max = 2000000000),
        'id_type_customer' => TypeCustomer::inRandomOrder()->value('id_type_customer'),
        'full_name' => $faker->randomElement(null, $faker->company),
        'first_name' => $faker->name,
        'last_name' => $faker->lastName,
        'email' => $faker->safeEmail,
    ];
});

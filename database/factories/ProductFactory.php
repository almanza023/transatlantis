<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Category;
use App\Models\Product;
use App\Models\TypeUnit;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'id_type_unit' => TypeUnit::inRandomOrder()->value('id_type_unit'),
        'id_category' => Category::inRandomOrder()->value('id_category'),
        'name_product' => $faker->unique()->randomElement(['Roca Caliza', 'Mármol', 'Granito', 'Pizarra', 'Aridos', 'Baldosas', 'Ladrillos Refractarios'
        ,'Loza Sanitaria', 'Vidrio', 'Lana de Vidrio', 'Bovedillas', 'Tejas', 'Yeso', 'Mortero', 'Hormigón', 'Acero ', 'Cobre', 'Aluminio']),
        'description' => $faker->text,
        'type_price' => 1,
        'weight' => $faker->randomDigit,
        'volume' => $faker->randomDigit,
        'price' => null,
        'product_status' => 1
        //'url' => $faker->imageUrl(1024, 1024)
    ];
});

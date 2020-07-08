<?php

use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{

    public function run()
    {
        factory(App\Models\Product::class, 15)->create()->each(function ($product) {

            $product->prices()->save(factory(App\Models\Price::class)->make());
            
        });
    }
}

<?php

use Illuminate\Database\Seeder;

class TypeProviderSeeder extends Seeder
{
    
    public function run()
    {
        factory(\App\Models\TypeProvider::class, 2)->create();
    }
}

<?php

use Illuminate\Database\Seeder;

class TypeUnitSeeder extends Seeder
{
    
    public function run()
    {
        factory(\App\Models\TypeUnit::class, 4)->create();
    }
}

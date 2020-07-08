<?php

use Illuminate\Database\Seeder;

class ProviderSeeder extends Seeder
{

    public function run()
    {
        factory(\App\Models\Provider::class, 20)->create();
    }
    
}

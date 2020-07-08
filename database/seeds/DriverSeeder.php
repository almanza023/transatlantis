<?php

use Illuminate\Database\Seeder;

class DriverSeeder extends Seeder
{

    public function run()
    {
        factory(\App\Models\Driver::class, 10)->create();
    }
}

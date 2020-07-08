<?php

use Illuminate\Database\Seeder;

class TimePaymentSeeder extends Seeder
{
    
    public function run()
    {
        factory(\App\Models\TimePayment::class, 15)->create();
    }
}

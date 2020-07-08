<?php

use Illuminate\Database\Seeder;

class TypePaymentSeeder extends Seeder
{

    public function run()
    {
        factory(\App\Models\TypePayment::class, 2)->create();
    }
}

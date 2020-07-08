<?php

use App\Models\TypeCustomer;
use Illuminate\Database\Seeder;

class TypeCustomerSeeder extends Seeder
{

    public function run()
    {
        TypeCustomer::create([
            'type_customer' => 'Juridico',
            'description' => 'Persona Juridica',
        ]);

        TypeCustomer::create([
            'type_customer' => 'Natural',
            'description' => 'Persona Natural',
        ]);
    }
}

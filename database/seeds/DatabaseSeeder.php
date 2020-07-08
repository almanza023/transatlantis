<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {

        $this->call(DepartamentSeeder::class);
        $this->call(AdminSeeder::class);
        $this->call(TypeCustomerSeeder::class);
        $this->call(OrderStatusSeeder::class);
        $this->call(TimePaymentSeeder::class);
        $this->call(TypePaymentSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(TypeUnitSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(CustomerSeeder::class);

        $this->call(TypeProviderSeeder::class);
        $this->call(ProviderSeeder::class);
        $this->call(VehicleStatusSeeder::class);
        $this->call(VehicleSeeder::class);
        //$this->call(DriverSeeder::class);

    }
}

<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class VehicleSeeder extends Seeder
{

    public function run()
    {
        factory(App\Models\Vehicle::class, 10)->create()->each(function ($vehicle) {
            $vehicle->vehicleStatus()->attach([1], ['observation' => 'Vehiculo Libre', 'status' => 1]);
            $driver =  factory(\App\Models\Driver::class)->create();
            $vehicle->drivers()->attach($driver->nid_driver, ['date_assigment' => Carbon::now(), 'status' => 1]);
        });
    }
}

<?php

use App\Models\VehicleStatus;
use Illuminate\Database\Seeder;

class VehicleStatusSeeder extends Seeder
{

    public function run()
    {
        VehicleStatus::create([
            'name' => 'Disponible',
            'description' => 'Vehiculos con disponibilidad',
            'order_by' => 1,
        ]);

        VehicleStatus::create([
            'name' => 'Reparacion',
            'description' => 'Vehiculo En Reparacion',
            'order_by' => 2,
        ]);

        VehicleStatus::create([
            'name' => 'No Funcional',
            'description' => 'Vehiculo Sin Funcionamiento',
            'order_by' => 3,
        ]);

        VehicleStatus::create([
            'name' => 'Ocupado',
            'description' => 'Vehiculo sin disponibilidad',
            'order_by' => 4,
        ]);

    }
}

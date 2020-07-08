<?php

use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusSeeder extends Seeder
{
    
    public function run()
    {
        OrderStatus::create([
            'name' => 'Despacho',
            'description' => 'Pedidos con agenda',
            'order_by' => 1
        ]);

        OrderStatus::create([
            'name' => 'Entregado',
            'description' => 'Pedidos entregado',
            'order_by' => 2
        ]);

        OrderStatus::create([
            'name' => 'Pre-Orden',
            'description' => 'Pedidos sin revisar',
            'order_by' => 3
        ]);

        OrderStatus::create([
            'name' => 'Compra',
            'description' => 'Pedidos con orden de compra',
            'order_by' => 4
        ]);

        OrderStatus::create([
            'name' => 'Aprobado',
            'description' => 'Pedidos Aprobados',
            'order_by' => 5
        ]);

        OrderStatus::create([
            'name' => 'Rechazado',
            'description' => 'Pedidos rechazado',
            'order_by' => 6
        ]);

        OrderStatus::create([
            'name' => 'Aplazado',
            'description' => 'Pedidos Aplazados',
            'order_by' => 7
        ]);

        OrderStatus::create([
            'name' => 'Agendado',
            'description' => 'Pedidos Agendados',
            'order_by' => 8
        ]);
    }
}

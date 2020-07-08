<?php

use App\Models\CustomerDomicile;
use App\Models\OrderStatus;
use Illuminate\Database\Seeder;

class CustomerSeeder extends Seeder
{

    public function run()
    {
        factory(App\Models\Customer::class, 40)->create()->each(function ($customer) {

            $domicile = factory(App\Models\Domicile::class)->create();

            $customer_domicile = CustomerDomicile::create([
                'id_domicile' => $domicile->id_domicile,
                'nid' => $customer->nid,
                'priority' => 1,
            ]);
             /* 
            $order = $customer_domicile->orders()->save(factory(App\Models\Order::class)->make());

            $order->orderStatus()->attach([$this->getStatus()], ['observation' => 'Sin revisar', 'status' => 1]);

            $rand_details = rand(1, 8);

            for ($i = 0; $i < $rand_details; $i++) {
                $order->orderDetails()->save(factory(App\Models\OrderDetail::class)->make());
            }
            */
        });
    }

    public function getStatus()
    {
        $status = OrderStatus::select('id_order_status')
            ->where('name', 'Pre-Orden')
            ->first();

        return $status->id_order_status;
    }
}

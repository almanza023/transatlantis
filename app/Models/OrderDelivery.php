<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class OrderDelivery extends Model
{
    protected $table = 'deliveries_orders';

    protected $primaryKey = 'id_delivery_order';

    public $timestamps = true;

    protected $fillable = [
        'id_order',
        'status',
        'hour',
        'weight',
        'observation',
        'date'
    ];

    public function orders()
    {
        return $this->belongsToMany('App\Models\Orders', 'history_orders', 'id_order_status', 'id_order')
            ->withPivot('observation')
            ->withTimestamps();
    }

   

   
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class OrderInvoice extends Model
{
    protected $table = 'order_invoices';

    protected $primaryKey = 'id_order_invoice';

    public $timestamps = true;

    protected $fillable = [
        'id_order',
        'id_admin',
        'total',
        'type',
        'observation',
        'date'
    ];

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'admins', 'id_admin', 'id_admin');
         
    }

   

   
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Load extends Model
{
    protected $table = 'loads';

    protected $primaryKey = 'id_load';

    protected $fillable = [
        'id_order',
        'placa',
        'nid_driver',
        'id_product',
        'amount',
        'carried',
        'status'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    
    public function products()
    {
        return $this->hasMany('App\Models\Products', 'id_product', 'id_product');
    }
    
}

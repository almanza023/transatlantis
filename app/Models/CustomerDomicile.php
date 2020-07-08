<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustomerDomicile extends Model
{
    protected $table = 'customer_domicile';

    protected $primaryKey = 'id_customer_domicile';

    protected $fillable = [
        'nid',
        'id_domicile',
        'priority'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer','nid');
    }

    public function domicile()
    {
        return $this->belongsTo('App\Models\Domicile','id_domicile');
    }

    public function orders()
    {
        return $this->hasMany('App\Models\Order', 'id_order');
    }
}

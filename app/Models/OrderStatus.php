<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class OrderStatus extends Model
{
    protected $table = 'order_status';

    protected $primaryKey = 'id_order_status';

    public $timestamps = false;

    protected $fillable = [
        'name',
        'description',
        'order_by'
    ];

    public function orders()
    {
        return $this->belongsToMany('App\Models\Orders', 'history_orders', 'id_order_status', 'id_order')
            ->withPivot('observation')
            ->withTimestamps();
    }

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = ucfirst($value);
    }

   
}

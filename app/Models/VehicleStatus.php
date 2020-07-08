<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VehicleStatus extends Model
{
    protected $table = 'vehicle_status';

    protected $primaryKey = 'id_vehicle_status';


    protected $fillable = [
        'name',
        'description',
        'order_by'
    ];

    public function vehicles()
    {
        return $this->belongsToMany('App\Models\Vehicle', 'history_vehicles', 'id_vehicle_status', 'placa')
            ->withPivot('observation')
            ->withTimestamps();
    }
}

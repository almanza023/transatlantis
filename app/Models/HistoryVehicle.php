<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryVehicle extends Model
{
    protected $table = 'history_vehicles';

    protected $primaryKey = 'id_history_vehicle';

    protected $fillable = [
        'placa',
        'id_vehicle_status',
        'observation',
        'status'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function vehicle()
    {
        return $this->belongsTo('App\Models\Vehicle', 'placa');
    }

    public function vehicleStatus()
    {
        return $this->belongsTo('App\Models\VehicleStatus', 'id_vehicle_status');
    }
}

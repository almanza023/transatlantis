<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles';

    protected $primaryKey = 'placa';

    protected $keyType = 'string';

    public $incrementing = false;

    protected $fillable = [
        'placa',
        'model',
        'type_vehicle',
        'brand',
        'volume',
        'capacity',
    ];

    protected $hidden = [
        'created_at', 'updated_at',
    ];

    public function orderScheduleDetails()
    {
        return $this->hasMany('App\Models\OrderScheduleDetail', 'placa');
    }

    public function orderSchedules()
    {
        return $this->belongsToMany('App\Models\OrderSchedule', 'order_schedule_details', 'placa', 'id_order_schedule');
    }

    public function drivers()
    {
        return $this->belongsToMany('App\Models\Driver', 'driver_vehicle', 'placa', 'nid_driver')
            ->withPivot('date_assigment', 'date_departure', 'status')
            ->withTimestamps();
    }

    public function currentDriver()
    {
        return $this->belongsToMany('App\Models\Driver', 'driver_vehicle', 'placa', 'nid_driver')
            ->wherePivot('status', 1);
    }

    public function vehicleStatus()
    {
        return $this->belongsToMany('App\Models\VehicleStatus', 'history_vehicles', 'placa', 'id_vehicle_status')
            ->withPivot('observation')
            ->withTimestamps();
    }

    public function driverActive()
    {
        return $this->hasMany('App\Models\DriverVehicle', 'placa')
            ->where('status', 1)
            ->orderBy('id_driver_vehicle', 'DESC');
    }

    public function scopeActive($query)
    {
        return $query->join('history_vehicles as hv', 'hv.placa', '=', 'vehicles.placa')
            ->join('vehicle_status as vs', 'hv.id_vehicle_status', '=', 'vs.id_vehicle_status')
            ->where('hv.status', 1)
            ->where('vs.name', 'Disponible');
    }

    public function setPlacaAttribute($value)
    {
        $this->attributes['placa'] = strtoupper($value);
    }
}

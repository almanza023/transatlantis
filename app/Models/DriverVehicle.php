<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class DriverVehicle extends Model
{
    protected $table = 'driver_vehicle';

    protected $primaryKey = 'id_driver_vehicle';

    protected $fillable = [
        'placa',
        'nid_driver',
        'date_assigment',
        'date_departure',
        'status'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function vehicle()
    {
        return $this->belongsTo('App\Models\Vehicle', 'placa');
    }

    public function driver()
    {
        return $this->belongsTo('App\Models\Driver', 'nid_driver');
    }

    public static function DriverVehicle()
    {
        return DB::table('driver_vehicle as dv')->join('drivers as d', 'dv.nid_driver', '=', 'd.nid_driver')   

            ->select(
                'dv.placa',
                'dv.nid_driver',
                'd.first_name',
                'd.last_name'               
            )->distinct()->get();
        
    }
    public static function DriverPlaca($placa)
    {
        return DB::table('driver_vehicle as dv')
        ->join('drivers as d', 'dv.nid_driver', '=', 'd.nid_driver')   
        ->join('vehicles as v', 'dv.placa', '=', 'v.placa')   
            ->where('dv.placa', $placa)
            ->select(
                'dv.placa',
                'dv.nid_driver',
                'd.first_name',
                'v.brand',
                'd.last_name'               
            )->get();
        
    }

    public static function DriverNid($nid)
    {
        return DB::table('driver_vehicle as dv')->join('drivers as d', 'dv.nid_driver', '=', 'd.nid_driver')   
            ->where('dv.nid_driver', $nid)
            ->select(
                'dv.placa',
                'dv.nid_driver',
                'd.first_name',
                'd.last_name'               
            )->get();
        
    }

  
   
}

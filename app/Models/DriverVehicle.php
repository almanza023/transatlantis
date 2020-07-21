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

    public static function getLiquidacion($nid, $date1, $date2){
        
        if($nid==0){
            $reusl=DB::select("SELECT CONCAT(d.first_name,' ',d.last_name) AS driver, l.ticket, l.carried,
             l.id_order, l.placa, l.nid_driver, od.percentage, l.flete, tu.type_unit, l.updated_at FROM loads l
            INNER JOIN orders o ON o.id_order=l.id_order
            INNER JOIN order_details od ON od.id_order=o.id_order
            INNER JOIN drivers d ON l.nid_driver=d.nid_driver
            INNER JOIN products p ON p.id_product=l.id_product
            INNER JOIN type_units tu ON p.id_type_unit=tu.id_type_unit
            WHERE l.id_product=od.id_product and l.status=2 and date(l.updated_at)>=? and date(l.updated_at)<=?
            ORDER BY  l.id_order DESC", [$date1, $date2]);
            return $reusl;
        }else{
            $reusl=DB::select("SELECT CONCAT(d.first_name,' ',d.last_name) AS driver, l.ticket, l.carried, 
            l.id_order, l.placa, l.nid_driver, od.percentage, l.flete, tu.type_unit, l.updated_at FROM loads l
            INNER JOIN orders o ON o.id_order=l.id_order
            INNER JOIN order_details od ON od.id_order=o.id_order
            INNER JOIN drivers d ON l.nid_driver=d.nid_driver
            INNER JOIN products p ON p.id_product=l.id_product
            INNER JOIN type_units tu ON p.id_type_unit=tu.id_type_unit
            WHERE l.id_product=od.id_product and l.status=2 and l.nid_driver=? and  date(l.updated_at)>=? and date(l.updated_at)<=?
            ORDER BY  l.id_order DESC", [$nid, $date1, $date2]);
            return $reusl;
        }

        
    }

  
   
}

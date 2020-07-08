<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderScheduleDetail extends Model
{
    protected $table = 'order_schedule_details';

    protected $primaryKey = 'id_order_schedule_details';

    protected $fillable = [
        'id_order_schedule',
        'placa',
        'nid_driver',
        'description_carga',
        'time_return',
        'time_stimated',
        'nro_viaje',
        'status'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function orderSchedule()
    {
        return $this->belongsTo('App\Models\OrderSchedule', 'id_order_schedule');
    }

    public function vehicle()
    {
        return $this->belongsTo('App\Models\Vehicle', 'placa');
    }

    public function scopeEntregados($query, $nid, $date1, $date2)
    {
        return DB::select("SELECT os.id_order, CONCAT(d.first_name,' ',d.last_name) AS conductor, osd.placa, os.date_departure, os.time_departure, deo.date, deo.hour, deo.observation   FROM order_schedules os
        INNER JOIN order_schedule_details osd ON os.id_order_schedule=osd.id_order_schedule_details
        INNER JOIN drivers d ON d.nid_driver=osd.nid_driver
        INNER JOIN history_orders ho ON ho.id_order=os.id_order
        INNER JOIN deliveries_orders deo ON deo.id_order=os.id_order
        WHERE osd.nid_driver=? AND os.date_departure>=? AND os.date_departure<=? and ho.id_order_status=9 AND ho.`status`=0 AND deo.`status`<=2", [$nid, $date1, $date2]);
    }

  
    
}

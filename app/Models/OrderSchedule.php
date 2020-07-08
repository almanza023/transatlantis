<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class OrderSchedule extends Model
{
    protected $table = 'order_schedules';

    protected $primaryKey = 'id_order_schedule';

    protected $fillable = [
        'id_order',
        'description',
        'date_departure',
        'time_departure',
        'status',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    protected $appends = ['date_format'];

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'id_order');
    }

    public function orderScheduleDetails()
    {
        return $this->hasMany('App\Models\OrderScheduleDetail', 'id_order_schedule');
    }

    public function vehicles()
    {
        return $this->belongsToMany('App\Models\Vehicle', 'order_schedule_details', 'id_order_schedule', 'placa')->withPivot('description_carga', 'time_stimated');
    }

    public function scopeFindById($query, $id)
    {
        return $query->join('orders as o', 'o.id_order', '=', 'order_schedules.id_order')
            ->join('customer_domicile as cd', 'o.id_customer_domicile', '=', 'cd.id_customer_domicile')
            ->join('customers as c', 'cd.nid', '=', 'c.nid')
            ->join('domiciles as d', 'cd.id_domicile', '=', 'd.id_domicile')
            ->join('municipalities as m', 'd.id_municipality', '=', 'm.id_municipality')
            ->join('departaments as de', 'de.id_departament', '=', 'm.id_departament')
            ->select('c.nid',
                'c.first_name',
                'c.last_name',
                'c.full_name',
                'o.id_order',
                'o.date_order',
                'o.priority',
                'order_schedules.*',
                'm.name_municipality',
                'de.name_departament',
                'd.address',
                'd.additional'
            )
            ->where('order_schedules.id_order_schedule', $id);
    }

    public function getDateFormatAttribute()
    {
        $fecha = new Date($this->date_departure);
        return $this->date_departure = $fecha->format('l j F Y');
    }
}

<?php

namespace App\Models;

use App\Presenters\OrderPresenter;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Jenssegers\Date\Date;

class Order extends Model
{
    protected $table = 'orders';

    protected $primaryKey = 'id_order';

    protected $fillable = [
        'id_customer_domicile',
        'id_type_payment',
        'id_time_payment',
        'date_order',
        'discount',
        'type_inovice',
        'address_invoice',
        'priority',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    protected $appends = ['date_format', 'number_order'];

    public function typePayment()
    {
        return $this->belongsTo('App\Models\TypePayment', 'id_type_payment');
    }

    public function timePayment()
    {
        return $this->belongsTo('App\Models\TimePayment', 'id_time_payment');
    }

    public function customerDomicile()
    {
        return $this->belongsTo('App\Models\CustomerDomicile', 'id_customer_domicile');
    }

    public function orderSchedules()
    {
        return $this->hasMany('App\Models\OrderSchedule', 'id_order');
    }

    public function orderDetails()
    {
        return $this->hasMany('App\Models\OrderDetail', 'id_order');
    }

    public function historyOrders()
    {
        return $this->hasMany('App\Models\HistoryOrder', 'id_order');
    }

    public function orderStatus()
    {
        return $this->belongsToMany('App\Models\OrderStatus', 'history_orders', 'id_order', 'id_order_status')
            ->withPivot('observation', 'created_at', 'status')
            ->withTimestamps();
    }

    public function statusActive()
    {
        return $this->hasMany('App\Models\HistoryOrder', 'id_order')
            ->where('status', 1)
            ->orderBy('id_history_order', 'DESC');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'order_details', 'id_order', 'id_product')
            ->withPivot('amount', 'unit_price')
            ->withTimestamps();
    }

    public function scopeStatus($query, $status)
    {
        return $query->join('history_orders as ho', 'ho.id_order', '=', 'orders.id_order')
            ->join('order_status as os', 'ho.id_order_status', '=', 'os.id_order_status')
            ->join('customer_domicile as cd', 'orders.id_customer_domicile', '=', 'cd.id_customer_domicile')
            ->join('customers as c', 'cd.nid', '=', 'c.nid')
            ->join('order_details as od', 'orders.id_order', '=', 'od.id_order')
            ->join('type_customers as tc', 'c.id_type_customer', '=', 'tc.id_type_customer')
            ->select('c.nid', 'c.first_name', 'c.last_name', 'c.full_name', 'tc.type_customer', 'orders.id_order',
             'orders.date_order', 'orders.priority', 'os.name', 'ho.created_at')
        //->where('os.name', $status)
             ->where('ho.status', 1)
             ->where('ho.id_order_status', '>=', 3)
            ->orderBy('orders.id_order', 'DESC')
            ->distinct();
    }
    public function scopeStatusCotizacion($query, $id)
    {
        return $query->join('history_orders as ho', 'ho.id_order', '=', 'orders.id_order')
            ->join('order_status as os', 'ho.id_order_status', '=', 'os.id_order_status')
            ->join('customer_domicile as cd', 'orders.id_customer_domicile', '=', 'cd.id_customer_domicile')
            ->join('customers as c', 'cd.nid', '=', 'c.nid')
            ->join('type_customers as tc', 'c.id_type_customer', '=', 'tc.id_type_customer')
            ->select('c.nid', 'c.first_name', 'c.last_name', 'c.full_name', 'tc.type_customer', 'orders.id_order', 'orders.date_order', 'orders.priority', 'os.name', 'ho.created_at')
            ->where('ho.id_order_status', $id) 
            ->where('status', '1')          
            ->orderBy('orders.id_order', 'DESC');
    }
    public function scopeCotizacionCliente($query, $nid)
    {
        return $query->join('history_orders as ho', 'ho.id_order', '=', 'orders.id_order')
            ->join('order_status as os', 'ho.id_order_status', '=', 'os.id_order_status')
            ->join('customer_domicile as cd', 'orders.id_customer_domicile', '=', 'cd.id_customer_domicile')
            ->join('customers as c', 'cd.nid', '=', 'c.nid')
            ->join('type_customers as tc', 'c.id_type_customer', '=', 'tc.id_type_customer')
            ->select('c.nid', 'c.first_name', 'c.last_name', 'c.full_name', 'tc.type_customer', 'orders.id_order', 'orders.date_order', 'orders.priority', 'os.name', 'ho.created_at', 'ho.id_order_status', 'ho.status')
            ->where('status', 1)         
            ->where('c.nid', $nid)   
            ->where('ho.id_order_status', 2)  
            ->orWhere('ho.id_order_status', 12)         
                  
            ->orderBy('orders.id_order', 'DESC');
    }
    public function scopeCotizacionClienteFecha($query, $nid, $date1, $date2)
    {
        return $query->join('history_orders as ho', 'ho.id_order', '=', 'orders.id_order')
            ->join('order_status as os', 'ho.id_order_status', '=', 'os.id_order_status')
            ->join('customer_domicile as cd', 'orders.id_customer_domicile', '=', 'cd.id_customer_domicile')
            ->join('customers as c', 'cd.nid', '=', 'c.nid')
            ->join('type_customers as tc', 'c.id_type_customer', '=', 'tc.id_type_customer')
            ->select('c.nid', 'c.first_name', 'c.last_name', 'c.full_name', 'tc.type_customer', 'orders.id_order', 'orders.date_order', 'orders.priority', 'os.name', 'ho.created_at')
            ->where('ho.id_order_status', 2)           
            ->where('c.nid', $nid)           
            ->whereBetween('orders.date_order', [$date1, $date2]) 
            ->orderBy('orders.id_order', 'DESC');
    }
    public function scopeCotizacionAll($query, $date1, $date2)
    {
        return $query->join('history_orders as ho', 'ho.id_order', '=', 'orders.id_order')
            ->join('order_status as os', 'ho.id_order_status', '=', 'os.id_order_status')
            ->join('customer_domicile as cd', 'orders.id_customer_domicile', '=', 'cd.id_customer_domicile')
            ->join('customers as c', 'cd.nid', '=', 'c.nid')
            ->join('type_customers as tc', 'c.id_type_customer', '=', 'tc.id_type_customer')
            ->select('c.nid', 'c.first_name', 'c.last_name', 'c.full_name', 'tc.type_customer', 'orders.id_order', 'orders.date_order', 'orders.priority', 'os.name', 'ho.created_at')
            ->where('ho.id_order_status', '2')          
            ->whereBetween('orders.date_order', [$date1, $date2]) 
            ->orderBy('orders.id_order', 'DESC');
    }

    

    public function scopeStatusSpecific($query, $status)
    {
        $query->status('')->where('os.name', $status);
    }

    public function scopePriority($query, $priority)
    {
        $query->where('orders.priority', $priority);
    }

    public function scopeDateOrder($query, $date, $date2)
    {
        $query->whereBetween('orders.date_order', [$date, $date2]);
    }

    public function scopeFindById($query, $id)
    {
        return $query->join('customer_domicile as cd', 'orders.id_customer_domicile', '=', 'cd.id_customer_domicile')
            ->join('customers as c', 'cd.nid', '=', 'c.nid')
            ->join('domiciles as d', 'cd.id_domicile', '=', 'd.id_domicile')
            ->join('municipalities as m', 'd.id_municipality', '=', 'm.id_municipality')
            ->join('departaments as de', 'de.id_departament', '=', 'm.id_departament')
            ->join('type_payments as tp', 'orders.id_type_payment', '=', 'tp.id_type_payment')
            ->join('time_payments as tt', 'orders.id_time_payment', '=', 'tt.id_time_payment')
            ->where('orders.id_order', $id)
            ->select(
                'c.nid',
                'c.first_name',
                'c.last_name',
                'c.full_name',
                'c.id_type_customer',
                'orders.id_order',
                'orders.date_order',
                'orders.priority',
                'orders.discount',
                'm.name_municipality',
                'de.name_departament',
                'tp.id_type_payment',
                'tt.id_time_payment',
                'tp.type_payment',
                'tt.time_payment',
                'd.address',
                'd.additional',
                'cd.id_customer_domicile'
            );
    }

    public static function getAgendados($nid){
        
        $fecha = Carbon::now()->format('Y-m-d');
        if(!empty($nid)){
       
        $orders = DB::select('SELECT o.id_order, os.date_departure, os.time_departure,
        ho.observation, ho.id_order_status, o.type_invoice, concat(dr.first_name," ",dr.last_name) as conductor, osd.placa, osd.nid_driver, os.description  FROM orders o 
        INNER JOIN history_orders ho ON ho.id_order=o.id_order
        INNER JOIN order_schedules os ON os.id_order=o.id_order
        INNER JOIN order_schedule_details osd ON osd.id_order_schedule=os.id_order_schedule
        INNER JOIN drivers dr on dr.nid_driver=osd.nid_driver        
        where (ho.id_order_status=8 or ho.id_order_status=11) and dr.nid_driver=?  AND ho.`status`=1
        and os.date_departure=?
        ORDER BY os.id_order desc'
        , [$nid, $fecha]);
        }else{
            $orders = DB::select('SELECT o.id_order, os.date_departure, os.time_departure,
            ho.observation, ho.id_order_status, concat(dr.first_name," ",dr.last_name) as conductor, osd.placa, osd.nid_driver, os.description, o.type_invoice  FROM orders o 
            INNER JOIN history_orders ho ON ho.id_order=o.id_order
            INNER JOIN order_schedules os ON os.id_order=o.id_order
            INNER JOIN order_schedule_details osd ON osd.id_order_schedule=os.id_order_schedule
            INNER JOIN drivers dr on dr.nid_driver=osd.nid_driver
            WHERE (ho.id_order_status=8 or ho.id_order_status=11) AND ho.`status`=1 and os.date_departure=? ORDER BY os.id_order desc', [$fecha]);
        }

        return $orders;
    }

    public static function getFilterAgendados($placa, $date1, $date2){
        $orders = DB::select('SELECT o.id_order, os.date_departure, os.time_departure,
        ho.observation, ho.id_order_status, concat(dr.first_name," ",dr.last_name) as conductor, osd.placa, os.description, o.type_invoice  FROM orders o 
        INNER JOIN history_orders ho ON ho.id_order=o.id_order
        INNER JOIN order_schedules os ON os.id_order=o.id_order
        INNER JOIN order_schedule_details osd ON osd.id_order_schedule=os.id_order_schedule
        INNER JOIN drivers dr on dr.nid_driver=osd.nid_driver
        WHERE (ho.id_order_status=8 or ho.id_order_status=11)  and osd.placa=?  AND ho.`status`=1
        and os.date_departure>=? and os.date_departure<=?
         group by o.id_order ORDER BY os.date_departure desc'
        , [$placa, $date1, $date2]);
        return $orders;
    }

 
   
    

    

    public function getDateFormatAttribute()
    {
        $fecha = new Date($this->date_order);
        return $this->date_order = $fecha->format('l j F Y, H:i:s');
    }

    public function getNumberOrderAttribute()
    {
        return $this->id_order = str_pad($this->id_order, 5, '0', STR_PAD_LEFT);
    }

    public function present()
    {
        return new OrderPresenter($this);
    }
}

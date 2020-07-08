<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;

class HistoryOrder extends Model
{
    protected $table = 'history_orders';

    protected $primaryKey = 'id_history_order';

    protected $fillable = [
        'id_order',
        'id_order_status',
        'observation',
        'status',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    protected $casts = ['status' => 'boolean'];

    protected $appends = ['date_format'];

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'id_order');
    }

    public function orderStatus()
    {
        return $this->belongsTo('App\Models\OrderStatus', 'id_order_status');
    }

    public function getDateFormatAttribute()
    {
        
        $fecha = new Carbon($this->created_at);
        return $this->created_at = $fecha->format('Y-m-d');
    }
}

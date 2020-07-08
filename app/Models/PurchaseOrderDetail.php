<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class PurchaseOrderDetail extends Model
{
    protected $table = 'purchase_order_details';

    protected $primaryKey = 'id_purchase';

    protected $fillable = [
        'nit',
        'id_order_detail',
        'amount',
        'cost'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function provider()
    {
        return $this->belongsTo('App\Models\Provider', 'nit');
    }

    public function orderDetail()
    {
        return $this->belongsTo('App\Models\OrderDetail', 'id_order_detail');
    }

    public static function getPurchaseOrder($id){
        return DB::table('purchase_order_details as pod')
            ->join('order_details as od', 'pod.id_order_detail', '=', 'od.id_order_detail')     
            ->where('od.id_order', $id)       
            ->select('pod.*')
            ->get();
    }
}

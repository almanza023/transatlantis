<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class OrderDetail extends Model
{
    protected $table = 'order_details';

    protected $primaryKey = 'id_order_detail';

    protected $fillable = [
        'id_order',
        'id_product',
        'amount',
        'percentage',
        'unit_price'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function order()
    {
        return $this->belongsTo('App\Models\Order', 'id_order');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'id_product');
    }

    public function providers()
    {
        return $this->belongsToMany('App\Models\Provider', 'purchase_order_details', 'id_order_detail', 'nit')
            ->withPivot('amount', 'cost', 'nit','id_order_detail', 'id_purchase')
            ->withTimestamps();
    }

    public static function getProductsOrder($id){
        return DB::table('orders as o')
        ->join('order_details as od', 'o.id_order', '=', 'od.id_order')
        ->join('products as p', 'od.id_product', '=', 'p.id_product')
        ->select('p.id_product', 'p.name_product')
        ->where('o.id_order', $id)
        ->get();

    }
    
}

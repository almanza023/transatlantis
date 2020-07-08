<?php

namespace App\Models;

use App\Presenters\ProviderPresenter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Provider extends Model
{
    protected $table = 'providers';

    protected $primaryKey = 'nit';

    public  $incrementing = false;

    protected $fillable = [
        'nit',
        'id_type_provider',
        'id_municipality',
        'full_name',
        'first_name',
        'last_name',
        'address',
        'email',
        'contact_number',
        'provider_status'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    protected $appends = ['name_complete'];

    protected $casts = ['provider_status' => 'boolean'];

    public function typeProvider()
    {
        return $this->belongsTo('App\Models\TypeProvider', 'id_type_provider');
    }

    public function municipality()
    {
        return $this->belongsTo('App\Models\Municipality', 'id_municipality');
    }

    public function orderDetails()
    {
        return $this->belongsToMany('App\Models\OrderDetail', 'purchase_order_details', 'nit', 'id_order_detail')
            ->withPivot('amount', 'cost')
            ->withTimestamps();
    }

    public function scopeActive($query){
        return $query->where('provider_status', 1);
    }

    public static function GetCantidades(){
        $users = DB::table('providers as pro')
        ->join('purchase_order_details as p', 'p.nit', '=', 'pro.nit')
        ->select('pro.full_name', DB::raw('count(*) as cantidad'))        
        ->groupBy('p.nit')->get();
        
        return $users;
    }
    

    public function getNameCompleteAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function setFullNameAttribute($value)
    {
        $this->attributes['full_name'] = strtoupper($value);
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = strtoupper($value);
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = strtoupper($value);
    }

    public function present()
    {
        return new ProviderPresenter($this);
    }

    public static function getProductos($nid){
        return DB::select("SELECT od.id_order, p.name_product, sum(od.amount) AS total FROM order_details od 
        INNER JOIN purchase_order_details pod ON od.id_order_detail=pod.id_order_detail
        INNER JOIN products p ON p.id_product=od.id_product
        INNER JOIN providers pro ON pro.nit=pod.nit
        WHERE pro.nit=?
        GROUP BY od.id_product", [$nid]);
    }
}

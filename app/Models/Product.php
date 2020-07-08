<?php

namespace App\Models;

use App\Presenters\ProductPresenter;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $primaryKey = 'id_product';

    protected $fillable = [
        'id_type_unit',
        'id_category',
        'name_product',
        'description',
        'type_price',
        'weight',
        'volume',
        'price',
        'product_status'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    protected $casts = ['product_status' => 'boolean'];


    public function typeUnit()
    {
        return $this->belongsTo('App\Models\TypeUnit', 'id_type_unit');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'id_category');
    }

    public function prices()
    {
        return $this->hasMany('App\Models\Price', 'id_product');
    }

    public function priceActive()
    {
        return $this->hasMany('App\Models\Price', 'id_product')
            ->orderBy('created_at', 'DESC')->where('price_status', 1);
    }

    public function orders()
    {
        return $this->belongsToMany('App\Models\Order', 'order_details', 'id_product', 'id_order')
            ->withPivot('amount', 'unit_price')
            ->withTimestamps();
    }

    public function setNameProductAttribute($value)
    {
        $this->attributes['name_product'] = strtoupper($value);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = ucfirst($value);
    }

    public function present()
    {
        return new ProductPresenter($this);
    }
}

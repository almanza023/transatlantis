<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Date\Date;


class Price extends Model
{
    protected $table = 'prices';

    protected $primaryKey = 'id_price';

    protected $fillable = [
        'id_product',
        'effective_date',
        'expiration_date',
        'price',
        'price_status'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    protected $casts = ['price_status' => 'boolean'];

    protected $appends = ['effective_format'];

    public function product()
    {
        return $this->belongsTo('App\Models\Product', 'id_product');
    }

    public function getEffectiveFormatAttribute()
    {
        $fecha = new Date($this->effective_date);
        return $this->effective_date = $fecha->format('l j F Y');
    }
}

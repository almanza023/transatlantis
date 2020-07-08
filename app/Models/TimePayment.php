<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TimePayment extends Model
{
    protected $table = 'time_payments';

    protected $primaryKey = 'id_time_payment';

    public $timestamps = false;

    protected $fillable = [
        'time_payment',
        'description'
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order', 'id_time_payment');
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = ucfirst($value);
    }
}

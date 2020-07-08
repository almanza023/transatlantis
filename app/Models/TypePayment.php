<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypePayment extends Model
{
    protected $table = 'type_payments';

    protected $primaryKey = 'id_type_payment';

    public $timestamps = false;

    protected $fillable = [
        'type_payment',
        'description'
    ];

    public function orders()
    {
        return $this->hasMany('App\Models\Order', 'id_type_payment');
    }

    public function setTypePaymentAttribute($value)
    {
        $this->attributes['type_payment'] = ucwords($value);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = ucfirst($value);
    }
}

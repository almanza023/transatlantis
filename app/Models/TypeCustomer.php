<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeCustomer extends Model
{
    protected $table = 'type_customers';

    protected $primaryKey = 'id_type_customer';

    public $timestamps = false;

    protected $fillable = [
        'type_customer',
        'description'
    ];

    public function customers()
    {
        return $this->hasMany('App\Models\Customer', 'id_type_customer');
    }
}

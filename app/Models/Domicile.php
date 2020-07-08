<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Domicile extends Model
{
    protected $table = 'domiciles';

    protected $primaryKey = 'id_domicile';

    protected $fillable = [
        'id_municipality',
        'address',
        'additional',
        'contact_number'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function customers()
    {
        return $this->belongsToMany('App\Models\Customer','customer_domicile', 'id_domicile', 'nid')
        ->withPivot('priority')
        ->withTimestamps();
    }

    public function municipality()
    {
        return $this->belongsTo('App\Models\Municipality', 'id_municipality');
    }


}

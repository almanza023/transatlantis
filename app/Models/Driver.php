<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{
    protected $table = 'drivers';

    protected $primaryKey = 'nid_driver';

    public $incrementing = false;

    protected $fillable = [
        'nid_driver',
        'first_name',
        'last_name',
        'address',
        'email',
        'contact_number',
        'contact_number_second',
        'blood_type',
        'date_birth',
        'medical_observation',
        'place_care',
        'arl',
        'driver_status'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    protected $appends = ['name_complete'];

    protected $casts = ['driver_status' => 'boolean'];


    public function vehicles()
    {
        return $this->belongsToMany('App\Models\Vehicle', 'driver_vehicle', 'nid_driver', 'placa')
            ->withPivot('date_assigment', 'date_departure', 'status')
            ->withTimestamps();
    }

    public function getNameCompleteAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = strtoupper($value);
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = strtoupper($value);
    }

    public function scopeViajes($query)
    {
        return $query->join('customer_domicile as cd', 'cd.nid', '=', 'customers.nid')
            ->join('domiciles as d', 'd.id_domicile', '=', 'cd.id_domicile')
            ->join('municipalities as m', 'd.id_municipality', '=', 'm.id_municipality')
            ->join('departaments as de', 'de.id_departament', '=', 'm.id_departament')
            ->select('customers.nid', 'customers.first_name', 'customers.email', 'customers.last_name', 'd.address', 'd.additional', 'm.name_municipality', 'de.name_departament')
            ->where('cd.priority', 1);
    }

}

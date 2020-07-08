<?php

namespace App\Models;

use App\Presenters\CustomerPresenter;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $table = 'customers';

    protected $primaryKey = 'nid';

    public $incrementing = false;

    protected $fillable = [
        'nid',
        'id_type_customer',
        'full_name',
        'first_name',
        'last_name',
        'email',
    ];

    protected $hidden = ['created_at', 'updated_at'];

    protected $appends = ['name_complete'];

    public function typeCustomer()
    {
        return $this->belongsTo('App\Models\TypeCustomer', 'id_type_customer');
    }

    public function domiciles()
    {
        return $this->belongsToMany('App\Models\Domicile', 'customer_domicile', 'nid', 'id_domicile')
            ->withPivot('priority')
            ->withTimestamps();
    }

    public function domicileCurrent()
    {
        return $this->belongsToMany('App\Models\Domicile', 'customer_domicile', 'nid', 'id_domicile')
            ->wherePivot('priority', 1)
            ->withPivot('id_customer_domicile');
    }

    public function customerDomiciles()
    {
        return $this->hasMany('App\Models\CustomerDomicile', 'nid');
    }

    public function getNameCompleteAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function setFullNameAttribute($value)
    {
        $this->attributes['full_name'] = ucwords($value);
    }

    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = ucwords($value);
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = ucwords($value);
    }

    public function scopeInfo($query)
    {
        return $query->join('customer_domicile as cd', 'cd.nid', '=', 'customers.nid')
            ->join('domiciles as d', 'd.id_domicile', '=', 'cd.id_domicile')
            ->join('municipalities as m', 'd.id_municipality', '=', 'm.id_municipality')
            ->join('departaments as de', 'de.id_departament', '=', 'm.id_departament')
            ->select('customers.nid', 'customers.first_name', 'customers.email', 'customers.last_name', 'd.address', 'd.additional', 'm.name_municipality', 'de.name_departament')
            ->where('cd.priority', 1);
    }

    public function present()
    {
        return new CustomerPresenter($this);
    }
}

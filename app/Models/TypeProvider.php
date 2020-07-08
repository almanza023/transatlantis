<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeProvider extends Model
{
    protected $table = 'type_providers';

    protected $primaryKey = 'id_type_provider';

    public $timestamps = false;

    protected $fillable = [
        'type_provider',
        'description'
    ];

    public function providers()
    {
        return $this->hasMany('App\Models\Provider', 'id_type_customer');
    }

    public function setTypeProviderAttribute($value)
    {
        $this->attributes['type_provider'] = ucwords($value);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = ucfirst($value);
    }
}

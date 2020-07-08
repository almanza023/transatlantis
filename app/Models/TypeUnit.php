<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeUnit extends Model
{
    protected $table = 'type_units';

    protected $primaryKey = 'id_type_unit';

    public $timestamps = false;

    protected $fillable = [
        'type_unit',
        'description'
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Product', 'id_type_unit');
    }

    public function setTypeUnitAttribute($value)
    {
        $this->attributes['type_unit'] = ucwords($value);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = ucfirst($value);
    }
}

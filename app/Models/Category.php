<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $primaryKey = 'id_category';

    public $timestamps = false;

    protected $fillable = [
        'name_category',
        'description'
    ];

    public function products()
    {
        return $this->hasMany('App\Models\Product', 'id_category');
    }

    public function setNameCategoryAttribute($value)
    {
        $this->attributes['name_category'] = ucwords($value);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = ucfirst($value);
    }

    
}

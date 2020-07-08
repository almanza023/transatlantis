<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Departament extends Model
{
    protected $table = 'departaments';

    protected $primaryKey = 'id_departament';

    public $timestamps = false;

    protected $fillable = [
        'name_departament',
    ];

    public function municipalities()
    {
        return $this->hasMany('App\Models\Municipality', 'id_departament');
    }
}

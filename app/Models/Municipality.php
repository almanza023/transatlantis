<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Municipality extends Model
{
    protected $table = 'municipalities';

    protected $primaryKey = 'id_municipality';

    public $timestamps = false;

    protected $fillable = [
        'id_departament',
        'name_municipality',
    ];

    public function departament()
    {
        return $this->belongsTo('App\Models\Departament', 'id_departament');
    }

    public function providers()
    {
        return $this->hasMany('App\Models\Provider', 'id_municipality');
    }

}

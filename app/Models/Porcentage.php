<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Porcentage extends Model
{
    protected $table = 'porcentages';

    protected $primaryKey = 'id';

    public $timestamps = false;

    protected $fillable = [
        'valor'
        ];

    

    
}

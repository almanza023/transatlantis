<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Admin extends Model
{
    protected $table = 'admins';

    protected $primaryKey = 'id_admin';


    protected $fillable = [
        'first_name',
        'document',
        'last_name',
        'address',
        'email',
        'contact_number'
    ];

    protected $hidden = [
        'created_at', 'updated_at'
    ];


    public function setFirstNameAttribute($value)
    {
        $this->attributes['first_name'] = strtoupper($value);
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = strtoupper($value);
    }
    public function user()
    {
        return $this->morphOne('App\User', 'usable');
    }

    public static function getAll(){

       return DB::table('admins as a')
            ->join('users as u', 'u.usable_id', '=', 'a.id_admin')          
            ->join('role_user as rs', 'u.id', '=', 'rs.user_id')
            ->join('roles as r', 'r.id', '=', 'rs.role_id')
            ->select('a.*', 'r.name as rol', 'u.user_status as estado', 'u.id as idusuario')
            ->where('u.type_user','<=', 2)
            ->get();
            
    }

    public static function getId($id){

        return DB::table('admins as a')
             ->join('users as u', 'u.usable_id', '=', 'a.id_admin')          
             ->join('role_user as rs', 'u.id', '=', 'rs.user_id')
             ->join('roles as r', 'r.id', '=', 'rs.role_id')
             ->select('a.*', 'r.name as rol', 'u.user_status as estado', 'u.id as idusuario')
             ->where('u.type_user','<=', 2)
             ->where('a.id_admin', $id)
             ->get();
             
     }
}

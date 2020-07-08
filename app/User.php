<?php

namespace App;

use Caffeinated\Shinobi\Concerns\HasRolesAndPermissions;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable, HasRolesAndPermissions;


    protected $fillable = [
        'type_user', 'email', 'password', 'user_status'
    ];


    protected $hidden = [
        'password', 'remember_token', 'created_at', 'updated_at'
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function usable()
    {
        return $this->morphTo();
    }

    public function admin()
    {
        return $this->belongsTo('App\Models\Admin', 'usable_id', 'id_admin');
    }
}

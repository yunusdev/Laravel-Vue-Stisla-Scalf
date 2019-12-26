<?php

namespace App\Model\Admin;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class Admin extends Authenticatable
{
    use Notifiable, HasRoles;

    protected $guard_name = 'admin';

    protected $fillable = [
        'name', 'email', 'password','phone', 'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];



//    public function getNameAttribute($value){
//
//        return ucfirst($value);
//
//    }

    public function photo(){

        return $this->belongsTo('App\Model\User\Photo');

    }

}

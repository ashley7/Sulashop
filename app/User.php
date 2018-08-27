<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Zizaco\Entrust\Traits\EntrustUserTrait;

class User extends Authenticatable
{
    use EntrustUserTrait;

    protected $fillable = [
        'name', 'email', 'password','phone_number',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
    	return $this->belongsToMany('App\Role','role_user');
    }
}

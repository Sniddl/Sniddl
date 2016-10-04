<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username','phone','avatar','color', 'confirmation_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function Posts()
    {
        return $this->hasMany('App\Post');
    }

    /*public function Reposts()
    {
        return $this->hasMany('App\Repost');
    }*/

    public function Friends()
    {
        return $this->hasMany('App\Friend');
    }

    public function Reposts()
    {
        return $this->hasMany('App\Repost');
    }
}

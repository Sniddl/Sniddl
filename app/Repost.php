<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Repost extends Model
{
    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function Reposter(){
        return User::find($this->reposter_id)->first();
    }
}

<?php

namespace App;

use App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Timeline extends Model
{
    protected $table = 'timeline';

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function AddedBy() {
      return User::find($this->added_by)->display_name;
    }
}

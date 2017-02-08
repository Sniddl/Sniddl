<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function post()
    {
      return $this->belongsTo('App\Post', 'post_id');
    }
}

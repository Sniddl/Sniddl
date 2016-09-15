<?php

namespace App;
use App\Eloquent;

use Illuminate\Database\Eloquent\Model;



class Timeline extends Model
{
  protected $table = 'timeline';

  public function post() {
    return $this->belongsTo('App\Post');
  }
}

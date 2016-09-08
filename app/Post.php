<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class Post extends Model
{
  public function likes()
  {
    return $this->hasMany('App\Like');
  }


  public function reposts()
  {
    return $this->hasMany('App\Repost');
  }

  public function user() {
    return $this->belongsTo('App\User');
  }


}

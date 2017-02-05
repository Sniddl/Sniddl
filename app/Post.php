<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{

    protected $fillable = [
        'community_id',
        'text',
        'url',
        'user_id',
    ];


    public function user() {
      return $this->belongsTo('App\User');
    }

    public function community() {
      return $this->belongsTo('App\Community');
    }
}

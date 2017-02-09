<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Repost extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'post_id',
        'reposter',
        'op',
    ];

    public function post()
    {
      return $this->belongsTo('App\Post', 'post_id');
    }
}

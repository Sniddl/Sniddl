<?php

namespace App;

use App\Eloquent;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class Timeline extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'timeline';

    public function post()
    {
        return $this->belongsTo('App\Post');
    }

    public function AddedBy() {
      return User::find($this->added_by);
    }
}

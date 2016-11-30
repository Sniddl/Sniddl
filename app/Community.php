<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Community extends Model
{
  protected $fillable = ['name', 'description', 'url', 'avatar'];
  protected $table = 'communities';


  public function Posts() {
    return Post::where('community_id','=',$this->id);}

  public function Owner() {
    return User::find($this->id);}



}//end of class

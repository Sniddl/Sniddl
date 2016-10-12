<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Community extends Model
{
  protected $fillable = ['name', 'description', 'url', 'avatar'];


  protected $table = 'communities';
}

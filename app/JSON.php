<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\JSON;

class JSON extends Model
{
  use SoftDeletes;
  protected $dates = ['deleted_at'];
  protected $table = 'json';
  protected $fillable = [
      'json',
      'site',
  ];


  public static function create($site, $url, $api_result){
    $json = JSON::withTrashed()->firstOrCreate([
      'site' => strtolower($site)
    ]);
    $json->json = $api_result;
    $json->save();
  }

  public static function get($site){
    $json = JSON::where('site',$site)->first();
    return json_decode($json->json);
  }

}

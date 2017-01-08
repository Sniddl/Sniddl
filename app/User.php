<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use App\Friend;
use App\User;
use \Request;
use \Auth;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'display_name', 'email', 'password','username','phone','avatar_url','avatar_bg_color', 'banner_url','banner_bg_color', 'confirmation_code', 'isDark',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //protected $dates = ['deleted_at'];

    public function Posts(){
        return $this->hasMany('App\Post');}

    public function Friends(){
      return Friend::where('follower_id', '=', $this->id)
                      ->where('are_friends', '=', 1);}

    public function Followers(){
      return Friend::where('being_followed_id', '=', $this->id)
                    ->where('are_friends', '=', 0);}
    public function Following(){
      return Friend::where('follower_id', '=', $this->id)
                    ->where('are_friends', '=', 0);}
    public function Timeline(){
      return Timeline::orderBy('id', 'DESC')->where('added_by', '=', $this->id);}

    public function Reposts(){
        return $this->hasMany('App\Repost');}

    public function AuthFriend(){
      return Friend::where('being_followed_id','=', $this->id )
                   ->where('follower_id', '=', Auth::user()->id)->exists();}

    public static function GetRequest($column, $index){
      return User::where($column,'=',Request::segment($index));}

    public function OwnerOf(){
      return Community::where('owner_id','=',$this->id);
    }

}//end of class

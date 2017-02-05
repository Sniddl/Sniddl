<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
     protected $fillable = [
         'avatar_bg_color',
         'avatar_url',
         'banner_bg_color',
         'banner_url',
         'display_name',
         'email',
         'is_dark',
         'password',
         'phone',
         'username',

         'confirmation_code',
         'ip_created',
         'ip_latest',
         'ip_updated_at',
     ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [

        'password',
        'remember_token',
    ];

    public function posts(){
      return $this->hasMany('App\Post');
    }

    public function replies(){
      return Reply::where('user_id','=',$this->id)->get();
    }

    public function events(){
      return Event::where('added_by','=',$this->id)->get();
    }

    public function reposts(){
      return Repost::where('reposter','=',$this->id)->get();
    }

    public function likes(){
      return Like::where('user_id','=',$this->id)->get();
    }

    public function friends(){
      return Friend::where('follower', '=', $this->id)
                      ->where('are_friends', '=', 1);}

    public function followers(){
      return Friend::where('being_followed', '=', $this->id)
                    ->where('are_friends', '=', 0);}

    public function following(){
      return Friend::where('follower', '=', $this->id)
                    ->where('are_friends', '=', 0);}

    public function owner_of_communites(){
      return Community::where('owner','=',$this->id)->get();
    }

    public function member_of_communites(){
      return Community_Member::where('user_id','=',$this->id)->get();
    }


}

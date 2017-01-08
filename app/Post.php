<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];


    public function likes()
    {
        return $this->hasMany('App\Like');
    }

    public function reposts()
    {
        return $this->hasMany('App\Repost');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function Replies(){
        return Reply::where('replyto_id',"=",$this->id)->get();
    }
    public function ReplyTo(){
        $getreply = Reply::withTrashed()->where('post_id',"=",$this->id)->first();
        $getop = Post::withTrashed()->find($getreply->replyto_id);
        return $getop;
    }

    public function TimelineOP(){
      return Timeline::withTrashed()
                      ->where('post_id','=',$this->id)
                      ->first();
    }



}

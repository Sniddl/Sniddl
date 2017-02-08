<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Reply;
use App\Event;
use Exception;

class Post extends Model
{

    protected $fillable = [
        'community_id',
        'text',
        'url',
        'user_id',
    ];

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
        return Reply::where('post_id',"=",$this->id)->get();
    }
    public function ReplyTo(){
        $getreply = Reply::withTrashed()->where('post_id',"=",$this->id)->first();
        $getop = Post::withTrashed()->find($getreply->replyto_id);
        return $getop;
    }

    // public function TimelineOP(){
    //   return Event::withTrashed()
    //                   ->where('post_id','=',$this->id)
    //                   ->first();
    // }


    public function event(){
      return Event::where('post_id', '=', $this->id);
    }
    public function community() {
      return $this->belongsTo('App\Community');
    }










    public static function create($array){
      // return abort(503);

      $p = new Post;
      $p->url = rand_64(11);
      $p->user_id = $array['user_id'];
      $p->community_id = $array['community_id'];
      $p->text = $array['text'];

      try {
        $p->save();
        $post_id = $p->id;

        $e = new Event;
        $e->post_id = $post_id;
        $e->added_by = $array['user_id'];
        $e->is_reply = FALSE;
        $e->save();
      } catch (Exception $e) {
          return abort(503);
      }
    }





    public static function drop(Post $post){
      // return "hello";
      $post->event()->delete();
      $post->delete();

    }
}

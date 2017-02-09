<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Reply;
use App\Event;
use App\Repost;
use App\Like;
use Auth;
use Carbon\Carbon;
use Exception;

class Post extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
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










    public static function create(array $array){
      if ($array){
        $p = new Post;
        $p->url = rand_64(11);
        $p->user_id = $array['user_id'];
        $p->community_id = $array['community_id'];
        $p->text = $array['text'];

        try {
          $p->save();
          Event::create($p, "post");
        } catch (Exception $e) {
            return abort(503);
        }
      }
    }



    public function repost(){
      // Search all reposts. Even the SoftDeletes.
      // If the repost doesn't exist, then create it.
      // If it does, check if it is deleted.
      // If it is deleted, then restore it.
      // Otherwise, if it already exsists & isn't brand new, then delete it.
      $currentTime = noMicroseconds();
      $repost = Repost::withTrashed()->firstOrCreate([
        'post_id' => $this->id,
        'reposter' => Auth::id(),
        'op' => $this->user->id,
      ]);
      if($repost->trashed()){
        $repost->restore();
        Event::create($this, "repost");
      }else if ($repost->created_at != $currentTime){
        Event::drop($repost->post, "repost");
        $repost->delete();
      }
    }




    public function like(){
      // Search all likes. Even the SoftDeletes.
      // If the likes doesn't exist, then create it.
      // If it does, check if it is deleted.
      // If it is deleted, then restore it.
      // Otherwise, if it already exsists & isn't brand new, then delete it.
      $currentTime = noMicroseconds();
      $like = Like::withTrashed()->firstOrCreate([
        'post_id' => $this->id,
        'user_id' => Auth::id(),
      ]);
      // dd($currentTime, $like->created_at);
      if($like->trashed()){
        $like->restore();
      }else if ($like->created_at != $currentTime){
        $like->delete();
      }
    }



    public function drop(){
      // return "hello";
      $this->event()->delete();
      $this->delete();

    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Reply;
use App\Event;
use App\Vote;
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



    public function votes()
    {
        return $this->hasMany('App\Vote');
    }
    public function voted($type, $class){
      $vote = Vote::where('post_id',$this->id)
                  ->where('voter', Auth::id());
      if($vote->exists()){
        if ($vote->first()->type == strtolower($type)){
          return $class;
        }
      }
    }
    public function ups()
    {
        return $this->votes->where('type','=', 'up');
    }
    public function downs()
    {
        return $this->votes->where('type','=', 'down');
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



    public function vote($type){
      // Search all reposts. Even the SoftDeletes.
      // If the repost doesn't exist, then create it.
      // If it does, check if it is deleted.
      // If it is deleted, then restore it.
      // Otherwise, if it already exsists & isn't brand new, then delete it.

      $currentTime = noMicroseconds();
      $vote = Vote::withTrashed()->firstOrCreate([
        'post_id' => $this->id,
        'voter' => Auth::id(),
        'op' => $this->user->id,
      ]);
      $currentType = $vote->type;
      $vote->type = $type;
      $vote->save();

      if($vote->trashed()){
        $vote->restore();
        // Event::create($this, "vote");
      }else if ($vote->created_at != $currentTime && $currentType == $type){
        // Event::drop($vote->post, "vote");
        $vote->delete();
      }
    }




    // public function like(){
    //   // Search all likes. Even the SoftDeletes.
    //   // If the likes doesn't exist, then create it.
    //   // If it does, check if it is deleted.
    //   // If it is deleted, then restore it.
    //   // Otherwise, if it already exsists & isn't brand new, then delete it.
    //   $currentTime = noMicroseconds();
    //   $like = Like::withTrashed()->firstOrCreate([
    //     'post_id' => $this->id,
    //     'user_id' => Auth::id(),
    //   ]);
    //   // dd($currentTime, $like->created_at);
    //   if($like->trashed()){
    //     $like->restore();
    //   }else if ($like->created_at != $currentTime){
    //     $like->delete();
    //   }
    // }



    public function drop(){
      // return "hello";
      $this->event()->delete();
      $this->delete();

    }
}

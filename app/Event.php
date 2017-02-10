<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Post;
use Auth;
use Exception;

class Event extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $fillable = [
        'post_id',
        'added_by',
        'is_repost',
        'is_reply'
    ];

    public function post()
    {
      return $this->belongsTo('App\Post', 'post_id');
    }

    public static function create(Post $p, string $string){
        // Search all events. Even the SoftDeletes.
        // If the post/repost/etc.. doesn't exist, then create it.
        // If it does, check if it is deleted.
        // If it is deleted, then restore it.

        switch (strtolower($string)) {
          case 'post':
            $post = Event::withTrashed()->firstOrCreate([
              'post_id' => $p->id,
              'added_by' => Auth::id(),
            ]);
            if( $post->trashed() ){
              $post->restore();}
            break;

          case 'reply':
            $reply = Event::withTrashed()->firstOrCreate([
              'post_id' => $p->id,
              'added_by' => Auth::id(),
              'is_reply' => TRUE
            ]);
            if( $reply->trashed() ){
              $reply->restore();}
            break;

          case 'vote':
            $vote = Event::withTrashed()->firstOrCreate([
              'post_id' => $p->id,
              'added_by' => Auth::id(),
              'is_vote' => TRUE
            ]);
            if( $vote->trashed() ){
              $vote->restore();}
            break;

          default:
            throw new Exception("Could not find event type.", 1);
            break;
        }
    }



    public static function drop(Post $post, string $string){
      $e = Event::where('post_id','=', $post->id);
      // dd($post);
      if (strtolower($string) == "repost") {
        $e->where('is_repost','=', TRUE)
          ->where('is_reply','=', FALSE)
          ->delete();
      }else if (strtolower($string) == "reply") {
        $e->where('is_repost','=', FALSE)
          ->where('is_reply','=', TRUE)
          ->delete();
      }else if (strtolower($string) == "post") {
        $e->where('is_repost','=', FALSE)
          ->where('is_reply','=', FALSE)
          ->delete();
      }
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Like;
use App\User;
use App\Repost;
use DB;
use Auth;

class PostController extends Controller
{
    //
    public function create()
    {
      $user = User::where('name','=', Auth::user()->name)->first();
      Post::insert(['text' => request()->text, 'user' => $user->name, 'user_id' => $user->id]);
      //DB::table('posts')->update(['text' => "hehe I just chaned automatically!"]);

      return back();
    }

    public function get()
    {
      $posts = Post::all();
      return view('showAllPosts', compact('posts'));
    }

    public function like(Post $post){
      if (!$post->likes()->where('user','=',Auth::user()->name)->exists()){
        Like::insert(['user' => Auth::user()->name, 'post_id' => $post->id]);
      }else {
        $post->likes()->where('user','=',Auth::user()->name)->delete();
      }
      return back();
    }


    public function repost(Post $post){
      //return $post->user;
      if (!$post->reposts()->where('user','=',Auth::user()->name)->exists() && $post->user != Auth::user()->name){
        Repost::insert(['user' => Auth::user()->name, 'post_id' => $post->id, 'user_id' => Auth::user()->id]);
      }else {
        //return Repost::where('user','=',Auth::user()->name)->delete();
        //$post->reposts()->where('user','=',Auth::user()->name)->delete();
        Repost::where('user','=',Auth::user()->name)->delete();
      }
      return back();
    }


}

/*

array(1) {
  [0]=> object(stdClass)#173 (11) {
    ["id"]=> int(1)
    ["text"]=> string(33) "hehe I just chaned automatically!"
    ["user"]=> string(3) "zeb"
    ["community"]=> string(0) ""
    ["trending"]=> int(1)
    ["liked"]=> int(0)
    ["reposted"]=> int(0)
    ["likes"]=> int(0)
    ["reposts"]=> int(0)
    ["created"]=> string(19) "2016-09-04 15:30:49"
    ["updated"]=> string(19) "2016-09-04 15:34:42"
}
}

*/

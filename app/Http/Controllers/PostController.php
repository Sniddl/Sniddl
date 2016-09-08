<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Like;
use App\User;
use App\Repost;
use App\Friend;
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
      $posts = Post::orderBy('id', 'DESC')->get();
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
      //return $post->user;
      if (!$post->reposts()->where('user_id','=',Auth::user()->id)->exists() && $post->user != Auth::user()->name){
        //return $post->user_id;
        Repost::insert(['op' => $post->user, 'post_id' => $post->id, 'user_id' => Auth::user()->id]);
      }else {
        //return Repost::where('user','=',Auth::user()->name)->delete();
        //$post->reposts()->where('user','=',Auth::user()->name)->delete();
        Repost::where('user_id','=',Auth::user()->id)->where('post_id','=',$post->id)->delete();
      }
      return back();
      //return $post;
    }

    public function delete(){
      Post::destroy(request()->id);
      return back();
    }


    public function sort(){
      //!App\Friend::where('user_id','=',1)->where('user','=',Auth::user()->name)->exists()
      //return var_dump(!\App\Friend::where('user_id','=',1)->where('user','=',Auth::user()->name)->exists());

      $friends = Friend::where('user','=',Auth::user()->name)->get();

      $array = [];
      foreach ($friends as $friend) {
        //echo $friend->User."<br><br>";
        $posts = $friend->User->posts;
        //echo "<br>".$posts."<br>";
        foreach($posts as $post){
          //echo "<br>".$post->id."<br>";
          array_push($array,$post->id);
        }
      }
      //var_dump($array);
      $posts = Post::orderBy('id', 'DESC')->whereIn('id', $array)->orWhere('user_id','=',Auth::user()->id)->get();
      //return $posts;
      return view('showAllPosts', compact('posts'));
      //return Friend::first()->User;
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

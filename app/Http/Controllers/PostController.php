<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Like;
use App\User;
use App\Repost;
use App\Friend;
use App\Timeline;
use DB;
use Auth;

class PostController extends Controller
{
    ///
    public function create(Request $request)
    {
      $this->validate($request, [
        'text' => 'required|string',
      ]);

      $user = User::where('username','=', Auth::user()->username)->first();
      //Post::insert(['text' => request()->text, 'user' => $user->username, 'user_id' => $user->id]);
      //return var_dump($request->text);
      $post = new Post();
      $post->text = $request->text;
      $post->user = $user->username;
      $post->user_id = $user->id;
      $post->save();

      $post_id = $post->id;

      $timeline = new Timeline();
      $timeline->post_id = $post_id;
      $timeline->added_by = $user->username;
      $timeline->is_repost = 0;
      $timeline->save();

      return back();
      //DB::table('posts')->update(['text' => "hehe I just chaned automatically!"]);
      //return Response::json(array('success' => true, 'last_insert_id' => $data->id), 200);

    }

    public function get()
    {
      $timeline = Timeline::orderBy('id', 'DESC' )->get();
      return view('showAllPosts', compact('timeline'));
    }



    public function like(Post $post){
      if (!$post->likes()->where('user','=',Auth::user()->username)->exists()){
        Like::insert(['user' => Auth::user()->username, 'post_id' => $post->id, 'user_id' => Auth::user()->id]);
      }else {
        $post->likes()->where('user','=',Auth::user()->username)->delete();
      }
      return back();
    }




    public function repost(Post $post){
      //return $post->user;
      //return $post->user;
      if (!$post->reposts()->where('user_id','=',Auth::user()->id)->exists() && $post->user != Auth::user()->username){
        //return $post->user_id;
        Repost::insert(['op' => $post->user, 'post_id' => $post->id, 'user_id' => Auth::user()->id]);

        $timeline = new Timeline();
        $timeline->post_id = $post->id;
        $timeline->added_by = Auth::user()->username;
        $timeline->is_repost = 1;
        $timeline->save();
      }else {
        //return Repost::where('user','=',Auth::user()->name)->delete();
        //$post->reposts()->where('user','=',Auth::user()->name)->delete();
        Repost::where('user_id','=',Auth::user()->id)->where('post_id','=',$post->id)->delete();
        Timeline::where('post_id','=',$post->id)->where('is_repost','=',1)->where('added_by','=',Auth::user()->username)->delete();
      }
      return back();
      //return $post;
    }

    


    public function sort(){
      //!App\Friend::where('user_id','=',1)->where('user','=',Auth::user()->name)->exists()
      //return var_dump(!\App\Friend::where('user_id','=',1)->where('user','=',Auth::user()->name)->exists());

      $friends = Friend::where('follower','=',Auth::user()->username)->get();

      $array = [];
      foreach ($friends as $friend) {
        //echo $friend->User."<br><br>";
        $posts = $friend->User->posts;
        //echo "<br>".$posts."<br>";
        foreach($posts as $post){
          //echo "<br>".$post->id."<br>";
          array_push($array,$post->user);
        }
      }
      //var_dump($array);
      $timeline = Timeline::orderBy('id', 'DESC')->whereIn( 'added_by', $array )->get();
      //return $posts;
      return view('showAllPosts', compact('timeline'));
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

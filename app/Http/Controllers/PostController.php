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

        $user = User::where('username', '=', Auth::user()->username)->first();
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
        $timeline = Timeline::orderBy('id', 'DESC')->get();
        //return $timeline = Timeline::orderBy('id', 'DESC')->first()->post;
        return view('showAllPosts', compact('timeline'));
    }



    public function like(Request $request)
    {
        $post = Post::find($request->id);
        if (!$post->likes()->where('user', '=', Auth::user()->username)->exists()) {
            Like::insert(['user' => Auth::user()->username, 'post_id' => $post->id, 'user_id' => Auth::user()->id]);
        } else {
            $post->likes()->where('user', '=', Auth::user()->username)->delete();
        }
        return response()->json([
          'likeAmount' => $post->likes->count()
        ]);
    }




    public function repost(Request $request)
    {
      //return $post->user;
      //return $post->user;
        $post = Post::find($request->id);
        //Repost::insert(['op' => $post->user, 'post_id' => $post->id, 'user_id' => Auth::user()->id]);

        $already_reposted = $post->reposts()->where('user_id', '=', Auth::user()->id)->exists();
        if (!$already_reposted && $post->user != Auth::user()->username) {
            //return $post->user_id;
            Repost::insert(['op' => $post->user, 'post_id' => $post->id, 'user_id' => Auth::user()->id]);

            $timeline = new Timeline();
            $timeline->post_id = $post->id;
            $timeline->added_by = Auth::user()->username;
            $timeline->is_repost = 1;
            $timeline->save();
        } else {
            //return Repost::where('user','=',Auth::user()->name)->delete();
            //$post->reposts()->where('user','=',Auth::user()->name)->delete();
            Repost::where('user_id', '=', Auth::user()->id)->where('post_id', '=', $post->id)->delete();
            Timeline::where('post_id', '=', $post->id)->where('is_repost', '=', 1)->where('added_by', '=', Auth::user()->username)->delete();
        }
        return response()->json([
        'repostAmount' => $post->reposts->count()
      ]);
      //return $post;
    }




    public function sort()
    {
      //!App\Friend::where('user_id','=',1)->where('user','=',Auth::user()->name)->exists()
      //return var_dump(!\App\Friend::where('user_id','=',1)->where('user','=',Auth::user()->name)->exists());

        $friends = Friend::where('follower', '=', Auth::user()->username)->get();

        $array = [];
        foreach ($friends as $friend) {
            //echo $friend->User."<br><br>";
            $posts = $friend->User->posts;
            //echo "<br>".$posts."<br>";
            foreach ($posts as $post) {
                //echo "<br>".$post->id."<br>";
                array_push($array, $post->user);
            }
        }
      //var_dump($array);
        $timeline = Timeline::orderBy('id', 'DESC')->whereIn('added_by', $array)->get();
      //return $posts;
        return view('showAllPosts', compact('timeline'));
      //return Friend::first()->User;
    }







    public function url($timeline_id) {
      $getPostByUrl = Timeline::find($timeline_id);
      return view('layouts.post-rendered')->with('timeline', $getPostByUrl);
    }



}







//

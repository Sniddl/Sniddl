<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Repost;
use Auth;
use App\Post;

class UserController extends Controller
{
  public function getProfile(){
    $user = User::where('username','=',Request()->user)->first(); //get the instance of the user.

    $array = []; //create an empty array
    foreach($user->reposts as $repost){
      array_push($array,$repost->post->id); //add all the post_id's of the reposts
    };

    // Order by id descending | where id = arrary of repost | or where it is orginally posted by user.
    $posts = Post::orderBy('id', 'DESC')->whereIn('id', $array)->orWhere('user_id','=',$user->id)->get();
    return view('showUserPosts', compact('posts'));
    //return \App\User::where('username','=',Request::segment(2))->first()->name;
  }

  public function toggleNewbieNotifications(){
    $user = User::find(Auth::user()->id);
    $user->newbieNotifications = 1;
    $user->save();
    return back();
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Repost;
use Auth;

class UserController extends Controller
{
  public function getProfile(){
    $user_id = User::where('name','=',request()->user)->first()->id;
    //return $user_id;
    $data = [
      'posts' => User::where('name','=',request()->user)->first()->posts,
      'reposts' => Repost::where('user_id','=',$user_id)->get(),
      'username' => request()->user,
    ];

    //->post->text;
    //return($data);
    return view('showUserPosts', compact('data'));
  }
}

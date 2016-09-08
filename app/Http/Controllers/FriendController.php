<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Friend;
use Auth;

class FriendController extends Controller
{
    public function add(){
      //Friend::insert(['user_id' => Auth::user()->id, 'user' => Request()->user]);
      if (!Friend::where('user_id','=',Request()->id)->where('user','=',Auth::user()->username)->exists()){
        Friend::insert(['user_id' => Request()->id, 'user' => Auth::user()->username]);
        //return back()->with('is_friend', True);
      }else {
        Friend::where('user_id','=',Request()->id)->where('user','=',Auth::user()->username)->delete();
        //return back()->with('is_friend', False);
      }
      return back();

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Friend;
use Auth;
use App\User;

class FriendController extends Controller
{
    public function add($id)
    {
      //Friend::insert(['user_id' => Auth::user()->id, 'user' => Request()->user]);
        $friendAdded                 =  Friend::where('being_followed_id', '=', $id)->where('follower_id', '=', Auth::user()->id)->exists();
        $userBeingFollowed           =  User::find($id);
        $userIsFollowingYouAlready   =  Friend::where('follower_id', '=', $userBeingFollowed->id)->where('being_followed_id', '=', Auth::user()->id);

        if ($friendAdded) {
            $gettingDeleted = Friend::where('being_followed_id', '=', $id)->where('follower_id', '=', Auth::user()->id)->first();
            if ($gettingDeleted->are_friends == 1) {
                $f = Friend::where('being_followed_id', '=', Auth::user()->id)->where('follower_id', '=', $id)->first();
                $f->are_friends = 0;
                $f->save();}
            $gettingDeleted->delete();
        }else{
            $f = new Friend;
            $f->being_followed_id = $id;
            $f->follower_id = Auth::user()->id;
            if ($userIsFollowingYouAlready->exists()) {
              $f->are_friends = 1;
              $userIsFollowingYouAlready->update(['are_friends' => 1]);}
            $f->save();
        }


        // if (!Friend::where('user_id', '=', Request()->id)->where('follower', '=', Auth::user()->username)->exists()) {
        //     //Friend::insert(['user_id' => Request()->id, 'user' => Auth::user()->username]);
        //
        //     $user_being_followed = User::find(Request()->id);
        //     $already_followed = Friend::where('follower', '=', $user_being_followed->username)
        //                           ->where('user_id', '=', Auth::user()->id);
        //
        //
        //     $friend = new Friend;
        //     $friend->user_id = Request()->id;
        //     $friend->follower = Auth::user()->username;
        //
        //     if ($already_followed->exists()) {
        //         $friend->are_friends = 1;
        //         $already_followed->update(['are_friends' => 1]);
        //         // you have to use this update method because using where is a mass selection, so you have to use a mass update.
        //     }
        //
        //     $friend->save();
        //     //return back()->with('is_friend', True);
        // } else {
        //     $gettingDeleted = Friend::where('user_id', '=', Request()->id)
        //                         ->where('follower', '=', Auth::user()->username)
        //                         ->first();
        //
        //     //return $gettingDeleted;
        //     if ($gettingDeleted->are_friends == 1) {
        //         $friend = Friend::where('user_id', '=', Auth::user()->id)
        //                   ->where('follower', '=', $gettingDeleted->User->username)
        //                   ->first();
        //
        //         $friend->are_friends = 0;
        //         $friend->save();
        //     }
        //
        //
        //
        //     $gettingDeleted->delete();
        // }
        return back();
    }
}

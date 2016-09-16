<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Repost;
use App\Timeline;
use Auth;
use App\Post;
use Image;
use File;


class UserController extends Controller
{
  public function getProfile(){
  /*  $user = User::where('username','=',Request()->user)->first(); //get the instance of the user.

    $array = []; //create an empty array
    foreach($user->reposts as $repost){
      array_push($array,$repost->post->id); //add all the post_id's of the reposts
    };

    // Order by id descending | where id = arrary of repost | or where it is orginally posted by user.*/
    $timeline = Timeline::orderBy('id', 'DESC' )->where('added_by','=',Request()->user)->get();
    return view('showUserPosts', compact('timeline'));
    //return \App\User::where('username','=',Request::segment(2))->first()->name;
  }

  public function toggleNewbieNotifications(){
    $user = User::find(Auth::user()->id);
    $user->newbieNotifications = 1;
    $user->save();
    return back();
  }


  public function update_avatar(Request $request) {

    $this->validate($request, [
      'avatar' => 'required|image',
    ]);

      $old_file = public_path(Auth::user()->avatar);



      if($request->hasFile('avatar')){
        $avatar = $request->file('avatar');
        $avatar_ext = $avatar->getClientOriginalExtension();


        if(File::exists( $old_file ) ){
          File::delete( $old_file );
        }

        //return var_dump($avatar);

        $filename = time(). '.' . $avatar->getClientOriginalExtension();
        //File::exists(storage_path('upload/avatars/' . $postId)) or File::makeDirectory(storage_path('upload/avatars/' . $postId));
        Image::make($avatar)->fit(300)->save( public_path('/uploads/avatars/' . $filename) );

        $user = Auth::user();
        $user->avatar = '/uploads/avatars/' . $filename;
        $user->save();
        return back();
     }
  }





  public function generate_avatar() {
    $length = 10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    //return $randomString;

    $user = Auth::user();
    $user->avatar = 'https://api.adorable.io/avatars/'.$randomString.'.png';
    $user->save();
    return back();

  }
}

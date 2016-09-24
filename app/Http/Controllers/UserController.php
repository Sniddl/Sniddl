<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Friend;
use App\Repost;
use App\Timeline;
use App\Http\Controllers\Auth\AuthController;

use Auth;
use App\Post;
use Image;
use File;
use DB;
use Validator;



class UserController extends Controller
{
  public function getProfile($user, $list = null){
    $user = User::where('username','=', $user)->first();
    $data = [
      'timeline' => Timeline::orderBy('id', 'DESC' )->where('added_by','=',$user->username)->get(),
      'following' => Friend::where('user','=',$user->username)->get(),
      'followers' => Friend::where('user_id','=', $user->id)->get(),
    ];

    switch ($list) {
      case 'following':
        return view('profile.lists.following', compact('data'));
        break;
      case 'followers':
        return view('profile.lists.followers', compact('data'));
        break;

      default:
        return view('profile.lists.posts', compact('data'));
        break;
    }

    /*if ($list == "following"){
      return view('profile.lists.following', compact('data'));
    }
    return view('profile.lists.posts', compact('data'));
*/
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





  public function generateAvatar() {
    $length = 15;

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);

    //$avatars = [];
    //for ($j = 0; $j < 15; $j++) {
      $randomString = '';
      for ($i = 0; $i < $length; $i++) {
          $randomString .= $characters[rand(0, $charactersLength - 1)];
      }
      //array_push($avatars, $randomString);
  //  }
    //return var_dump($data);
    //return $randomString;
    //$data = 'https://api.adorable.io/avatars/'.$randomString.'.png';
    $user = Auth::user();
    $user->avatar = 'https://api.adorable.io/avatars/'.$randomString.'.png';
    $user->save();
    return back();

  }

  // Allows the user the change their name
  public function updateName(Request $request)
  {
    $this->validate($request,[
      'displayname' => 'Min:3|Max:254|Alpha_dash|filled|regex:/^[0-9a-zA-Zs\s\-\_]*$/'
    ]);

    $name = $request->get('displayname');
    if ($name === Auth::user()->name){
      return back();
    }else{
      DB::table('users')
                ->where('id', Auth::user()->id)
                ->update(['name' => $name]);
    }
    return back();
  }

  // Changes password
  public function changePWD(Request $request){
    $this->validate($request,[
      'currentpassword'=>'required|filled',
      'newpassword'=> 'required|Min:6|filled',
      'verifynewpwd'=> 'required|Min:6|filled'
    ]);
    $currentpwd = $request->get('currentpassword');
    $newpwd     = $request->get('newpassword');
    $verifypwd  = $request->get('verifynewpwd');
    if (password_verify($currentpwd, Auth::user()->password)){
      if($newpwd === $verifypwd){
        DB::table('users')
                  ->where('id', Auth::user()->id)
                  ->update(['password' => bcrypt($verifypwd)]);
      }else{
        DB::table('users')
                  ->where('id', Auth::user()->id)
                  ->update(['name' => "PWDCHNGE_ERROR"]);
      }
    }else {
        DB::table('users')
                  ->where('id', Auth::user()->id)
                  ->update(['name' => "PWDCHNGE_ERROR"]);
    }
    return back();
  }

  // Allows the user the change their email
  public function changeEmail(Request $request){
    $this->validate($request,[
      'changeemail'=>'required|filled|email',
    ]);
    $changeemail = $request->get('changeemail');
    DB::table('users')
              ->where('id', Auth::user()->id)
              ->update(['email' => $changeemail]);
    return back();
  }
}

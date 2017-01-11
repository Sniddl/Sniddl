<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Friend;
use App\Repost;
use App\Upload;
use App\Timeline;
use App\Http\Controllers\Auth\AuthController;

use Auth;
use Mail;
use App\Post;
use Image;
use File;
use DB;
use Validator;
use \Session;
use Response;
use Storage;

class UserController extends Controller
{
    public function getProfile($user, $list = null){
        $user = User::where('username', '=', $user)->first();
        if ($user) {
            $data = [
              'timeline'  => $user->Timeline()->where('is_reply','=', 0)->get(),
              'following' => $user->Following()->get(),
              'followers' => $user->Followers()->get(),
              'friends'   => $user->Friends()->get()];

            switch ($list) {
                case 'following':
                    return view('profile.lists.following', compact('data'));
                break;
                case 'followers':
                    return view('profile.lists.followers', compact('data'));
                break;
                case 'friends':
                    return view('profile.lists.friends', compact('data'));
                break;

                default:
                    return view('profile.lists.posts', compact('data'));
                break;}
        } else {
            abort(404);}}

    public function update_avatar(Request $request){
        $avatar_path = upload_image($request->file('avatar'), 'ava', '/uploads/avatars/', 300, 300);
        $user = Auth::user();
        $user->avatar_url = $avatar_path;
        $user->avatar_bg_color = 'transparent';
        $user->save();
        return back();}

    public function update_banner(Request $request){
        $image_path = upload_image($request->file('banner'), 'ban', '/uploads/banners/', 1500, 500);
        $user = Auth::user();
        $user->banner_url = $image_path;
        $user->banner_bg_color = 'transparent';
        $user->save();
        return back();}

    // public function generateAvatar(){
    //     $hex = generateHex();
    //     if (hexInfo($hex, 'contrast') >= 130) {
    //         $textColor =  'black';
    //     } else {
    //         $textColor = 'white';}
    //     $user = User::find(Auth::user()->id);
    //     $user->avatar = '/uploads/defaults/letters/'.$textColor.'/'.strtolower(Auth::user()->display_name[0]).'.png';
    //     $user->color = $hex;
    //     $user->save();
    //     return back();}

    public function profileSettings(Request $request){
      $u = Auth::user();
      $this->validate($request, [
        'displayname' => 'min:3|max:50|regex:/^[a-zA-Z]+[a-zA-Z0-9\-\_]+(?: [\S]+)*$/',
        'username' => 'unique:users|max:20|alpha_dash',
        'newpassword' => 'min:6|confirmed',
        'changeemail'=>'email|max:255|unique:users,email'
      ]);
      if($request->has('displayname')){
        $u->display_name = $request->displayname;
      }
      if($request->has('username')){
        $u->username = $request->username;
      }
      if($request->has('newpassword') && password_verify($request->currentpassword,$u->password)){
        $u->password = bcrypt($request->newpassword);
      }
      if($request->has('changeemail')){
        $u->email = $request->changeemail;
      }

      $u->save();
      return back();}


    public function toggleDarkness() {
      $u = Auth::user();
      if($u->isDark == 0){
        $u->isDark = 1;
      }else{
        $u->isDark = 0;}
      $u->save();
      return back();}


      public function DeleteAcc(Request $request){
        $u = Auth::user();
        $this->validate($request, [
          'password' => 'min:6|confirmed',
        ]);
        if(password_verify($request->password,$u->password)){
            $u->username = '$_'.$u->username;
            $u->save();
            Post::where('user_id', '=', $u->id)->delete();
            Repost::where('op_id', '=', $u->id)->delete();
            Timeline::where('added_by', '=', $u->id)->delete();
            User::where('id', '=', $u->id)->delete();
        }
        flash('Success! You have deleted your account', 'success');
        return redirect('/');}



}//end of class

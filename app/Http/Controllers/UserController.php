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
              'timeline'  => $user->Timeline()->get(),
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





    public function resendVerification(){

        if (Auth::user()->confirmation_code) {
            email_signup(Auth::user());
            Session::forget('verify_fail');
            Session::put('verify_incomplete', 'Thank you for joining Sniddl, but you need to verify your e-mail if you wish to continue.');
        } else {
            Session::flash('notify_danger', "You think you're being clever? Try to break someone else's site instead.");}
        return back();}



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

    public function generateAvatar(){
        $hex = generateHex();
        if (hexInfo($hex, 'contrast') >= 130) {
            $textColor =  'black';
        } else {
            $textColor = 'white';}
        $user = User::find(Auth::user()->id);
        $user->avatar = '/uploads/defaults/letters/'.$textColor.'/'.strtolower(Auth::user()->name[0]).'.png';
        $user->color = $hex;
        $user->save();
        return back();}


    public function updateName(Request $request){
        $this->validate($request, [
          'displayname' => 'min:3|required|max:50|alpha_num',]);
        $name = $request->get('displayname');
        if ($name === Auth::user()->name) {
            return back();
        } else {
            $user = User::find(Auth::user()->id); //Updates if not
            $user->name = $name;
            $user->save();
            flash('Your name was changed successfully', 'success');}
        return back();}

    public function changePWD(Request $request){
        $this->validate($request, [
          'currentpassword'=>'required|filled',
          'newpassword'=> 'required|min:6|confirmed',]);
        $currentpwd = $request->get('currentpassword');
        $newpwd     = $request->get('newpassword');
        if (password_verify($currentpwd, Auth::user()->password)) {
            if ($newpwd !== $currentpwd) {
                  $user = User::find(Auth::user()->id);
                  $user->password = bcrypt($newpwd);
                  $user->save();
                  flash('Your password has been updated', 'success');
            }else{
                flash('Your new password cannot be the same as your current password', 'warning');}
        }else{
            flash('Your current password is incorrect', 'warning');}
        return back();}




    public function changeEmail(Request $request){
        $this->validate($request, [ //Validates the input with regex
          'changeemail'=> 'required|email|max:255|unique:users,email',]);
        $changeemail = $request->changeemail;
        if ($changeemail != Auth::user()->email) { //Checks if the new email entered is already equals to the user's curent email
            $user = User::find(Auth::user()->id); //If not the email is updated
            $user->email = $changeemail;
            $user->save();
            flash('Your email has been updated', 'success');
        }else{
            flash('Please enter a different, new email', 'warning');}
        return back();}



    public function verify($username, $code){
        $unverified = User::where('username', '=', $username)
                ->where('confirmation_code', '=', $code)
                ->first();
        $found = User::where('username', '=', $username)
                ->first();
        if ($unverified) {
            $unverified->confirmation_code = null;
            $unverified->newbieNotifications = 1;
            $unverified->save();
            Session::forget('verify_fail');
            Session::forget('verify_incomplete');
            Session::flash('verify_success', 'You have successfully verified your account!');
            return redirect('/');
        } elseif ($found->confirmation_code == null) {
            Session::forget('verify_fail');
            Session::forget('verify_incomplete');
            Session::flash('verify_success', 'You have already verified your account!');
            return redirect('/');
        } else {
            Session::put('verify_fail', 'It looks like we are having trouble verifying your account.');
            return redirect('/');}}



    public function confirmDeletion(){
        Flash::put('confirmDeletion', 'Are you sure you would like to delete your account?');
        return 2;}



    public function deactivate(Request $request){
        $deacusername = $request->get('deac-username');
        $deacpassword = $request->get('deac-password');
        if ($deacusername == Auth::user()->username) {
            if (password_verify($deacpassword, Auth::user()->password)) {
                $user = User::find(Auth::user()->id);
                $user->forceDelete();
                return redirect('register');
            }else{
                flash('The password you entered was incorrect');
                return back();}
        }else{
            Session::flash('test', 'The username you entered was incorrect');}}



    public function profileSettings(Request $r){
      $this->validate($r, [
        'newpassword' => 'min:6|confirmed',
        'displayname' => 'min:3|max:50|regex:/^[a-zA-Z]+[a-zA-Z0-9\-\_]+(?: [\S]+)*$/',
        'username' => 'unique:users|max:20|alpha_dash',
        'changeemail' => 'email|max:255|unique:users,email',]);
      $u = Auth::user();
      $u->name = $r->has('displayname') ? $r->displayname: $u->name ;
      $u->username = $r->has('username') ? $r->username: $u->username ;
      if($r->has('newpassword')){
        $this->validate($r, ['currentpassword'=>'required',]);
        if ( password_verify($r->currentpassword, $u->password) ) {
          $u->password = bcrypt($r->newpassword);
        }else {
          return Response::json(['error' => 'Your current password doesn\'t match '], 422);}}
      $u->email = $r->has('changeemail') ? $r->changeemail: $u->email ;
      $u->save();
      return $u;}


    public function toggleDarkness() {
      $u = Auth::user();
      if($u->isDark == 0){
        $u->isDark = 1;
      }else{
        $u->isDark = 0;}
      $u->save();
      return redirect('/edit/profile');}




}//end of class

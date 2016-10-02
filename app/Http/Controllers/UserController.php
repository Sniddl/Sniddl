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
use Mail;
use App\Post;
use Image;
use File;
use DB;
use Validator;
use \Session;



class UserController extends Controller
{


  public function getProfile($user, $list = null){
    $user = User::where('username','=', $user)->first();
    //return $user->id;
    $data = [
      'timeline' => Timeline::orderBy('id', 'DESC' )->where('added_by','=',$user->username)->get(),
      'following' => Friend::where('follower','=',$user->username)->get(),
      'followers' => Friend::where('user_id','=', $user->id)->get(),
      'friends' => Friend::where('follower','=', $user->username)
                          ->where('are_friends','=',1)
                          ->get()
    ];

    //return $data['friends']->User;

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
        break;
    }

    /*if ($list == "following"){
      return view('profile.lists.following', compact('data'));
    }
    return view('profile.lists.posts', compact('data'));
*/
  }

  public function resendVerification(){
    if (Auth::user()->confirmation_code){
      email_signup();
      Session::forget('verify_fail');
      Session::put('verify_incomplete', 'Thank you for joining Sniddl, but you need to verify your e-mail if you wish to continue.');
    }
    Session::flash('notify_danger', "You think you're being clever? Try to break someone else's site instead.");
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
    $hex = generateHex();

    if (hexInfo($hex, 'contrast') >= 130) {
      //bright color use dark text
      $textColor =  'black';
    }else {
      //dark color use light text
      $textColor = 'white';
    }

    $user = User::find(Auth::user()->id);
    $user->avatar = '/uploads/avatars/letters/'.$textColor.'/'.strtolower(Auth::user()->name[0]).'.png';
    $user->color = $hex;
    $user->save();



    //backup for testing email
    //email_signup();

    return back();
  }

  // Allows the user the change their name
  public function updateName(Request $request){
    $this->validate($request,[ //Validates the input with regex
      'displayname' => 'Min:3|max:50|filled|regex:/^[a-zA-Z]+[a-zA-Z0-9\-\_]+(?: [\S]+)*$/'
    ]);
    $name = $request->get('displayname');
    if ($name === Auth::user()->name){ //Checks if the name new name is equal to the users current name
      return back(); //If it is it will return the user back to save unnecessary DB calls
    }else{
      $user = User::find(Auth::user()->id); //Updates if not
      $user->name = $name;
      $user->save();
      flash('Your name was changed successfully', 'success');
    }
    return back();
  }

  // Changes password
  public function changePWD(Request $request){
    $this->validate($request,[ //Validates the input with regex
      'currentpassword'=>'required|filled',
      'newpassword'=> 'required|Min:6|filled',
      'verifynewpwd'=> 'required|Min:6|filled'
    ]);
    $currentpwd = $request->get('currentpassword');
    $newpwd     = $request->get('newpassword');
    $verifypwd  = $request->get('verifynewpwd');
      if (password_verify($currentpwd, Auth::user()->password)){ //Checks if the current password is equal to the user's current password in DB
        if($verifypwd !== $currentpwd){ //Checks if the new password entered is equal to the user's current password
          if($newpwd === $verifypwd){ //Checks if the 2 new passwords entered are equal
              $user = User::find(Auth::user()->id);
              $user->password = bcrypt($verifypwd);
              $user->save();
              flash('Your password has been updated','success');
          }else{
            flash("Your new passwords didn't match. Please enter them again",'warning');
          }
        }else{
          flash('Your new password cannot be the same as your current password','warning');
        }
      }else{
            flash('Your current password is incorrect','warning');
      }
    return back();
  }

  // Allows the user the change their email
  public function changeEmail(Request $request){
    $this->validate($request,[ //Validates the input with regex
      'changeemail'=>'required|filled|email',
    ]);
    $changeemail = $request->get('changeemail');
    if($changeemail !== Auth::user()->email){ //Checks if the new email entered is already equals to the user's curent email
      $user = User::find(Auth::user()->id); //If not the email is updated
      $user->email = $changeemail;
      $user->save();
      flash('Your email has been updated', 'success');
    }else{
      flash('Please enter a different, new email','warning');
    }
    return back();
  }


public function verify($username, $code){

    $unverified = User::where('username','=', $username)
                ->where('confirmation_code','=', $code)
                ->first();
    $found = User::where('confirmation_code','=', $code)
                ->first();

    if ($unverified){
      $unverified->confirmation_code = null;
      $unverified->newbieNotifications = 1;
      $unverified->save();
      Session::forget('verify_fail');
      Session::forget('verify_incomplete');
      Session::flash('verify_success', 'You have successfully verified your account!');
      return redirect('/');
    }
    elseif(!$found){
      Session::forget('verify_fail');
      Session::forget('verify_incomplete');
      Session::flash('verify_success', 'You have already verified your account!');
      return redirect('/');
    }
    else {
      Session::put('verify_fail', 'It looks like we are having trouble verifying your account.');
      return redirect('/');
    }
}

  public function deactivate(Request $request){
      $deacusername = $request->get('deac-username');
      $deacpassword = $request->get('deac-password');

      if($deacusername == Auth::user()->username){
          if(password_verify($deacpassword, Auth::user()->password)){
            $user = User::find(Auth::user()->id);
            $user->forceDelete();

            return redirect('register');
          }else{
            flash('The password you entered was incorrect');
            return back();
          }
      }else {
        flash('The username did not match', 'warning');
        return back();
      }
  }

}

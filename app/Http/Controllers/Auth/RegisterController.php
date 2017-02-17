<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $view = 'auth.index';
    protected $request;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'display_name' => 'required|max:255',
            // 'email' => 'required|email|max:255|unique:users',
            // 'password' => 'required|min:6|confirmed',
        ]);
    }


    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create( array $data)
    {

      $r = $this->request;
      $hex = generateHex();

        if (hexInfo($hex, 'contrast') > 130) {
          //bright color use dark text
          $textColor =  'black';
        }else {
          //dark color use light text
          $textColor = 'white';
        }

        // This has to be an array because it is passed through middleware that authenticates the user.
        // normally each column would be it's own parameter like the following...
        // $user->display_name = 'zebthewizard';
        return User::create([
          'display_name'      => $r->display_name,
          'username'          => $r->username,
          'email'             => $r->email,
          'password'          => bcrypt($r->password),
          'phone'             => "1234567890",
          'avatar_url'        => '/uploads/defaults/letters/'.$textColor.'/'.strtolower($r->name[0]).'.png',
          'avatar_bg_color'   => "#".$hex,
          'banner_bg_color'   => "#".$hex,
          'banner_url'        => '/uploads/defaults/low-poly.png',
          'confirmation_code' => str_random(30),
          'ip_created'        => $r->ip(),
          'ip_latest'         => $r->ip(),
          'ip_updated_at'     => new Carbon,
        ]);
    }
}

<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use App\Http\Controllers\Controller;
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
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
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
          'name' => 'min:3|required|max:50|regex:/^[a-zA-Z]+[a-zA-Z0-9\-\_]+(?: [\S]+)*$/',
          'username' => 'required|unique:users|max:20|alpha_dash',
          'email' => 'required|email|max:255|unique:users',
          'password' => 'required|min:6|confirmed',
          'phone' => 'required|regex:/^[+(0-9)]{1,6}[0-9()\s-]*$/|min:10|max:25',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {

      $hex = generateHex();

      if (hexInfo($hex, 'contrast') > 130) {
        //bright color use dark text
        $textColor =  'black';
      }else {
        //dark color use light text
        $textColor = 'white';
      }

        return User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => bcrypt($data['phone']),
            'avatar' => '/uploads/avatars/letters/'.$textColor.'/'.strtolower($data['name'][0]).'.png',
            'color' => $hex,
            'confirmation_code' => str_random(30),
        ]);
    }
}

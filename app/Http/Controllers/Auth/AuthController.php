<?php

namespace App\Http\Controllers\Auth;

use App\User;
use Validator;
use Mail;
use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use \Session;
use \Redirect;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $username = 'username';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
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

        $user = User::create([
            'name' => $data['name'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'phone' => bcrypt($data['phone']),
            'avatar' => '/uploads/avatars/letters/'.$textColor.'/'.$data['name'][0].'.png',
            'color' => $hex,
            'confirmation_code' => str_random(30),
        ]);


        email_signup($user);

        Session::put('verify_incomplete', 'Thank you for joining Sniddl, but you need to verify your e-mail if you wish to continue.');

        return $user;

    }







  /**
   * Handle a login request to the application.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function postLogin(Request $request)
  {
      // get our login input
      $login = $request->input('login');
      // check login field
      $login_type = filter_var( $login, FILTER_VALIDATE_EMAIL ) ? 'email' : 'username';
      // merge our login field into the request with either email or username as key
      $request->merge([ $login_type => $login ]);
      // let's validate and set our credentials
      if ( $login_type == 'email' ) {
          $this->validate($request, [
              'email'    => 'required|email',
              'password' => 'required',
          ]);
          $credentials = $request->only( 'email', 'password' );
      } else {
          $this->validate($request, [
              'username' => 'required',
              'password' => 'required',
          ]);
          $credentials = $request->only( 'username', 'password' );
      }
      if ($this->auth->attempt($credentials, $request->has('remember')))
      {
          return redirect()->intended($this->redirectPath());
      }
      return redirect($this->loginPath())
          ->withInput($request->only('login', 'remember'))
          ->withErrors([
              'login' => $this->getFailedLoginMessage(),
          ]);
}








}

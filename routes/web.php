<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {
    if(Auth::check()){
      return view('pages.home');
    }
    return view('pages.welcome');
});

Auth::routes();



Route::get('/user', function(Request $request){
  $u = \App\User::find(1);
  return response()
          ->json([
            "name" => $u->name,
            "user" => $u
          ]);
});

Route::post('/post', function(Request $r){
  dd($r->all());
});

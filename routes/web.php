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
    if (Auth::check()) {
      // $u = Auth::user();
      // $u->ip = $request->ip();
      // $u->save();
      $p = new \App\Post();
      $p->base64 = rand_64(11);
      $p->name = rand_64(7);
      $p->save();
    }
    // $post = new \App\Post;
    // $post->id = "cow";
    // $post->text = "hellow";
    // $post->save();
    return view('pages.welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('/user', function(Request $request){
  $u = \App\User::find(1);
  return response()
          ->json([
            "name" => $u->name,
            "user" => $u
          ]);
});

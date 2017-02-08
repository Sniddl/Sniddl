<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;
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
      $events = \App\Event::orderBy('id', 'DESC')->get();
      return view('pages.root.home',compact('events'));
    }
    return view('pages.root.welcome');
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

Route::get('/delete', function(Request $r){
  $post = Post::first();
  Post::drop($post);
  return;
});



Route::post('/post', function(Request $r){
  Post::create([
    "user_id" => 4,
    "community_id" => 1,
    "text" => $r->text
  ]);
  return back();
});





Route::get('/createpost', function(Request $r){
  Post::create([
    "user_id" => 4,
    "community_id" => 1,
    "text" => rand_64(2)
  ]);
  return redirect('/post');
});

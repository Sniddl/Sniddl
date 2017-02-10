<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Event;
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

Route::post('/post', 'PostController@create');
Route::post('/post/vote/{type}', 'PostController@vote')->middleware('ajax');
Route::post('/post/like', 'PostController@like')->middleware('ajax');





//--------------------------------------------------
// IGNORE THESE, THEY ARE JUST FOR QUICK TESTS.
// I STILL NEED THEM THOUGH, SO DON'T DELETE THEM.
//--------------------------------------------------
//
// Route::get('/user', function(Request $request){
//   $u = \App\User::find(1);
//   return response()
//           ->json([
//             "name" => $u->name,
//             "user" => $u
//           ]);
// });
//
// Route::get('/delete', function(Request $r){
//   $post = Post::find(15);
//   $e = Event::where('post_id','=', $post->id)
//             ->where('is_repost','=', TRUE)
//             ->where('is_reply','=', FALSE)
//             ->delete();
// });

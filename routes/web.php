<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;
use App\User;
use App\Event;
use App\JSON;
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

// Route::get('/login', function(Request $request){
//   $unsplash = JSON::where('site', 'unsplash_random')->first();
//   $json = json_decode($unsplash->json);
//   return view('auth.index', compact($json));
// });
// Route::get('/register', function(Request $request){
//   return view('auth.index');
// });

Auth::routes();

Route::post('/post', 'PostController@create');
Route::post('/post/vote/{type}', 'PostController@vote')->middleware('ajax');
Route::post('/post/like', 'PostController@like')->middleware('ajax');
Route::get('/testing/{view}', function(Request $request, $view){
  return view('testing.'.$view);
})->middleware('ajax');

Route::get('/api/remote/get/{site}', 'JSONController@get')->middleware('ajax');


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

Route::get('/createJSON', function(){
  return view('createJSON');
});

Route::post('/createJSON', function(Request $request){
  // dd($request->query, $request->url);
  $added_JSON = json_decode($request->json, true);
  $url = $request->url.'?'.http_build_query($added_JSON);
  $requested_JSON = file_get_contents($url);
  JSON::create($request->name, $request->url, $requested_JSON);
  dd(json_decode($requested_JSON)) ;
});

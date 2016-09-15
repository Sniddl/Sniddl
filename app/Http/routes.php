<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/', 'PostController@get');

Route::auth();

Route::get('/home', 'HomeController@index');

//Route::get('/create-post', 'PostController@create');
Route::get('/show-create-post', function () {
    return view('create-post');
});
Route::get('/updates', function () {
    return view('updates');
});

Route::post('/create-post', 'PostController@create');
Route::get('/like/{post}', 'PostController@like');
Route::get('/repost/{post}', 'PostController@repost');
Route::get('/u/{user}', 'UserController@getProfile');
Route::get('/delete/{id}', 'PostController@delete');
Route::get('/friend/{id}', 'FriendController@add');
Route::get('/sort/{type}', 'PostController@sort');
Route::get('/toggleNewbieNotifications', 'UserController@toggleNewbieNotifications');

Route::get('/edit/profile', function () {
    return view('editProfile');
});

Route::post('/edit/profile/avatar', 'UserController@update_avatar');
Route::post('/edit/profile/avatargen', 'UserController@generate_avatar');

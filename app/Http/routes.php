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

Route::post('/create-post', 'PostController@create');
Route::get('/like/{post}', 'PostController@like');
Route::get('/repost/{post}', 'PostController@repost');
Route::get('/u/{user}', 'UserController@getProfile');

<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Response;
use Auth;

class PostController extends Controller
{

  public function __construct(Request $request)
  {
    //code located here will run everytime the controller is called.
    // if( $request->header("AJAX") ){
    //   return Response::json($request);
    // }
  }


  public function create(Request $r) {
    Post::create([
      "user_id" => Auth::id(),
      "community_id" => 1,
      "text" => $r->text
    ]);
    return back();
  }


  public function repost(Request $request){
    $post = Post::find($request->post_id);
    if ( $post->user_id != Auth::id() ){
      $post->repost();
    }
    //adds data for ajax.
    $request->request->add([
      'count'=> $post->reposts()->count(),
    ]);
    //if ajax isn't used return back a page.
    return back();
  }


  public function like(Request $request){
    $post = Post::find($request->post_id);
    $post->like();
    //adds data for ajax.
    $request->request->add([
      'count'=> $post->likes()->count(),
    ]);
    //if ajax isn't used return back a page.
    return back();
  }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers;

class ReplyController extends Controller
{
    public function create(Request $request){
      // $r = new Reply;
      // $r->post_id = $request->post;
      // $r->user->id = $request->user;
      // $r->save();

      //return dd($request->all());
      $post = new PostController;
      $post->create($request, "reply");
      return back();
    }
}

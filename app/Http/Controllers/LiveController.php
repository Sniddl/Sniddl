<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use App\Timeline;

class LiveController extends Controller
{
    public function post(Request $request) {
      $last = new \DateTime($request->last_update);
      $thereAreNewPost = Timeline::where('created_at','>=', $last);
      return response()->json([
        'thereAreNewPost' => $thereAreNewPost->exists(),
        'amountOfNewPosts' => $thereAreNewPost->count(),]);}



        
}//end of class

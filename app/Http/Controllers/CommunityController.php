<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Community;

use App\Http\Requests;


class CommunityController extends Controller
{
    public function getCommunity($url){

      $getCommunity = Community::where('url', '=', $url)->first();
      if($getCommunity == ''){ //If a community was searched but doesn't exist a 404 will be thrown ,(Literally).
        abort(404);
      }else{
        return view('communities.community');
        //return $getCommunity;
      }

    }
}

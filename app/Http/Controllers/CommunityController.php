<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Community;
use App\User;

use App\Http\Requests;


class CommunityController extends Controller
{
    public function getCommunity($url){
      $getCommunity = Community::where('url', '=', $url)->first();
      if($getCommunity == ''){ //If a community was searched but doesn't exist a 404 will be thrown ,(Literally).
        abort(404);
      }else{
        $owner = User::where('id', '=', $getCommunity->owner)->first();
        //return $owner;
        return view('communities.community', compact('owner'));
        //return $getCommunity;
      }

    }
}

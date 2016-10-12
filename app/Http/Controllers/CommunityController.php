<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Community;
use App\User;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests;
use Auth;
use Storage;


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

    public function createCommunity(Request $request){
      $this->validate($request, [
      'createcommunityname' => 'required|min:5|regex:/[a-zA-Z0-9]/|unique:communities,name',
      'createcommunitydescription' => '',
      'createcommunityurl' => 'required|min:3|max:30|regex:/[a-zA-Z0-9]/|unique:communities,url',
      'createcommunityavatar' => 'required|image',
      ]);
      //Requesting the fields
      $communityname = $request->createcommunityname;
      $communitydescription = $request->createcommunitydescription;
      $communityurl = $request->createcommunityurl;

      $path = $request->file('createcommunityavatar')->store('public/image');
          $url = Storage::url($path);
  //    if($request->hasFile('createcommunityavatar')){
  //      $communityavatar = $request->file('createcommunityavatar');
  //      $createcommunityavatar_ext = $communityavatar->getClientOriginalExtension();

  //      $filename = 'comm_' . time(). '.' . $communityavatar->getClientOriginalExtension();
  //      Image::make($communityavatar)->fit(300)->save(public_path('/uploads/avatars/' . $filename));
  //    }
      //Creating the community
      $community = new Community();
      $community->name = $communityname;
      $community->description = $communitydescription;
      $community->owner = Auth::user()->id;
      $community->url = $communityurl;
      $community->avatar = $url;
      $community->save();

      return redirect('/c/'. $community->url);
    }
}

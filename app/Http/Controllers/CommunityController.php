<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Community;
use App\User;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests;
use Auth;
use Storage;
use Image;


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
      'createcommunityname' => 'required|min:5|regex:/^[a-zA-Z]+[a-zA-Z0-9\-\_]+(?: [\S]+)*$/|unique:communities,name',
      'createcommunitydescription' => 'required|string',
      'createcommunityurl' => 'required|min:3|max:30|alpha_num|unique:communities,url',
      'createcommunityavatar' => 'required|image',
      ]);
      //Requesting the fields
      $communityname = $request->createcommunityname;
      $communitydescription = $request->createcommunitydescription;
      $communityurl = $request->createcommunityurl;

      /*$path = $request->file('createcommunityavatar');
      $store = $request->file('createcommunityavatar')->store('public/image');
      $url = Storage::url($store);
      $resize= Image::make($path)->fit(300)->save($url);*/

      if($request->hasFile('createcommunityavatar')){
        $communityavatar = $request->file('createcommunityavatar');
        $createcommunityavatar_ext = $communityavatar->getClientOriginalExtension();
        // Format of the date() is "date, month, year, hour(12hr), minutes, seconds" **The date is based on machine time**
        $filename = 'comm_' . date("jFYhis") . '.' . $communityavatar->getClientOriginalExtension();
        Image::make($communityavatar)->fit(300)->save(public_path('/uploads/avatars/' . $filename));
      }
      //Creating the community
      $community = new Community();
      $community->name = $communityname;
      $community->description = $communitydescription;
      $community->owner = Auth::user()->id;
      $community->url = $communityurl;
      $community->avatar = '/uploads/avatars/'.$filename;
      $community->save();
      //return date("jFYhis");
      return redirect('/c/'. $community->url);
    }




    public function getList() {
      $communities = Community::orderBy('name')->get();
      //return $communities;
      return view('communities.list', compact('communities'));
    }

}

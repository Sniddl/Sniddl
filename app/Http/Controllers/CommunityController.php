<?php

namespace App\Http\Controllers;

use App\Community;
use App\User;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Requests;       //use App\Http\Requests;
use Illuminate\Http\Request; //use Illuminate\Http\Request;
use Auth;
use Storage;
use Image;
use App\CommunityMembers;
use DB;
//use Request;
//use Illuminate\Support\Facades\Request;


class CommunityController extends Controller
{
    public function getCommunity($url){
      $getCommunity = Community::where('url', '=', $url)->first();
      if($getCommunity == ''){ //If a community was searched but doesn't exist a 404 will be thrown ,(Literally).
        abort(404);
      }else{
        $id = $getCommunity->id;
        $owner = User::find($getCommunity->owner_id);
        //$membersTable = CommunityMembers::where('comm_id', '=', $id)->select('user_id')->get();
        //$membersProfile = User::where($membersTable)->get();
        $Members = DB::table('community_members')
                    ->join('users', 'users.id', '=', 'community_members.user_id')
                    ->where('comm_id', '=', $id)
                    ->get();
        //dd($Members);
        return view('communities.community', compact('owner','Members'));
        //return $getCommunity;
      }
    }

    public function createCommunity(Request $request){
      $this->validate($request, [
      'createcommunityname' => 'required|min:5|regex:/^[a-zA-Z]+[a-zA-Z0-9\-\_]+(?: [\S]+)*$/|unique:communities,name',
      'createcommunitydescription' => 'required|string',
      'createcommunityurl' => 'required|min:3|max:30|alpha_num|unique:communities,url',
      'createcommunityavatar' => 'image',
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
        $avatar_path = upload_image($request->file('createcommunityavatar'), 'comm', '/uploads/avatars/', 300,300);
      }
      //Creating the community
      $community = new Community();
      $community->name = $communityname;
      $community->desc = $communitydescription;
      $community->owner_id = Auth::user()->id;
      $community->url = $communityurl;
      $community->avatar = $avatar_path;
      $community->save();
      //return date("jFYhis");
      return redirect('/c/'. $community->url);
    }

    public function getList() {
      $communities = Community::orderBy('name')->get();
      $OwnerOf = Community::where('owner_id', '=', Auth::user()->id)->get();
      //return view('communities.list', compact('owner'))
      //return $communities;
      return view('communities.list', compact('communities', 'OwnerOf'));
    }

    public function Join(Request $request) {
      $id = $request->id;
      if(CommunityMembers::where('user_id', '=', Auth::user()->id)->where('comm_id','=', $id)->exists()){
        return redirect('/404');
      }else{
        $join = new CommunityMembers();
        $join->user_id = Auth::user()->id;
        $join->comm_id = $id;
        $join->save();
      }
      return back();
    }

}

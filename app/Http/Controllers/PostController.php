<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Post;
use App\Like;
use App\User;
use App\Repost;
use App\Friend;
use App\Timeline;
use App\Reply;
use DB;
use Auth;

class PostController extends Controller
{

    public function create(Request $request, $method=null){
        $this->validate($request, [
          'text' => 'required|string',]);
        $op = Post::find($request->id); //find the original post.
        $user = Auth::user();
        $post = new Post();
        $post->text = $request->text;
        $post->user_id = $user->id;
        $post->community_id = null;
        if ($method == "reply"){
            $post->isReply = 1;}
        $post->save();
        $post_id = $post->id;

        $timeline = new Timeline();
        $timeline->post_id = $post_id;
        $timeline->added_by = $user->id;
        $timeline->is_repost = 0;
        if ($method == "reply"){
            $timeline->is_reply = 1;
            $r = new Reply();
            $r->replyto_id = $op->id;//get the id global.js @reply click function.
            $r->post_id = $post_id; //the id of this post.
            $r->user_id = $user->id; //id of this user.
            $r->save();}
        $timeline->save();
        if ($method == null){
          return back();}}



    public function get(){
        $timeline = Timeline::orderBy('id', 'DESC')->where('is_reply','=', 0)->get();
        return view('showAllPosts', compact('timeline'));}



    public function like(Request $request){
        $post = Post::find($request->id);
        $currentLikes = $post->likes()->where('user_id', '=', Auth::user()->id);
        if ($currentLikes->exists()) {
            $currentLikes->delete();
        } else {
            $like = new Like;
            $like->post_id = $post->id;
            $like->user_id = Auth::user()->id;
            $like->save();}
        return response()->json([
            'likeAmount' => $post->likes->count()]);}




    public function repost(Request $request){
        $post = Post::find($request->id);
        $already_reposted = $post->reposts()->where('reposter_id', '=', Auth::user()->id)->exists();
        if (!$already_reposted && $post->user != Auth::user()->username) {
            $repost = new Repost;
            $repost->op_id = $post->user_id;
            $repost->post_id = $post->id;
            $repost->reposter_id = Auth::user()->id;
            $repost->save();
            $timeline = new Timeline();
            $timeline->post_id = $post->id;
            $timeline->added_by = Auth::user()->id;
            $timeline->is_repost = 1;
            $timeline->save();
        } else {
            Repost::where('reposter_id', '=', Auth::user()->id)
                    ->where('post_id', '=', $post->id)
                    ->delete();
            Timeline::where('post_id', '=', $post->id)
                      ->where('is_repost', '=', 1)
                      ->where('added_by', '=', Auth::user()->id)
                      ->delete();}
        return response()->json([
        'repostAmount' => $post->reposts->count()]);}




    public function sort(){
        $friends = Friend::where('follower_id', '=', Auth::user()->id)->get();
        $array = [];
        foreach ($friends as $friend) {
            $friendID = $friend->user_being_followed()->id;
            array_push($array, $friendID);
        }
        $timeline = Timeline::orderBy('id', 'DESC')->whereIn('added_by', $array)->where('is_reply', '=', '0')->get();
        return view('showAllPosts', compact('timeline'));
      }







    public function url($timeline_id) {
      $getPostByUrl = Timeline::find($timeline_id);
      return view('layouts.post-rendered')->with('timeline', $getPostByUrl);}



}//end of class








//

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
use DB;
use Auth;

class PostController extends Controller
{

    public function create(Request $request){
        $this->validate($request, [
          'text' => 'required|string',]);
        $user = User::where('username', '=', Auth::user()->username)->first();
        $post = new Post();
        $post->text = $request->text;
        $post->user_id = $user->id;
        $post->community_id = null;
        $post->save();
        $post_id = $post->id;
        $timeline = new Timeline();
        $timeline->post_id = $post_id;
        $timeline->added_by = $user->id;
        $timeline->is_repost = 0;
        $timeline->save();
        return back();}



    public function get(){
        $timeline = Timeline::orderBy('id', 'DESC')->get();
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
            $posts = $friend->User->posts;
            foreach ($posts as $post) {
                array_push($array, $post->user);}}
        $timeline = Timeline::orderBy('id', 'DESC')->whereIn('added_by', $array)->get();
        return view('showAllPosts', compact('timeline'));}







    public function url($timeline_id) {
      $getPostByUrl = Timeline::find($timeline_id);
      return view('layouts.post-rendered')->with('timeline', $getPostByUrl);}



}//end of class







//

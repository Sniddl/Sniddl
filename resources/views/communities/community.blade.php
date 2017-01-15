@extends('layouts.app')

@section('content')
  <?php $getCommunity = \App\Community::where('url','=',Request::segment(2))->first()?>
{{--$getCommunity gets the relevant information depending on the URL entered.--}}
{{--$owner gets the relevant information on the owner of the community.--}}

<div id="community-page" class="container">
  <div class="row">
{{--Left column--}}
      <div class="col-sm-6">
        <img class="img-circle" height="80px" style ="margin-right:10px;" src="{{$getCommunity->avatar}}"/>
        <h3 style="color:#0d0d0d;">{{$getCommunity->name}}</h3>
        <p style="color:#a8a8a8; padding-top:5px;"><b style="padding-right:10px;">URL</b> sniddl.com/c/{{$getCommunity -> url}}</p> <br>
        <form action="/join_community" method="post">
          {{ csrf_field() }}
          <button class="btn btn-primary" name="id" value="{{$getCommunity->id}}">Join</button>
        </form>
        <hr>
        <h3 style="text-align:center; color:#529bd5;">Staff</h3>
        <h4><img class="img-circle" height="50px" style ="margin-right:10px; background-color:{{$owner->avatar_bg_color}}; " src="{{ $owner->avatar_url }}"/>{{$owner->username}}</h4>
        <hr>
        <h3 style="text-align:center; color:#529bd5;">Members</h3>
        @foreach($Members->slice(0,20) as $Member)
        <h4><img class="img-circle" height="50px" style ="margin-right:10px; background-color:#{{$Member->avatar_bg_color}}; " src="{{ $Member->avatar_url }}"/>{{$Member->username}}</h4>
        @endforeach
      </div>
{{--Right column--}}
      <div class="col-sm-6">
        <p style="float:right; font-size:11pt; color:#a8a8a8; padding-top:27px;">{{$getCommunity->desc}}</p>
      </div>
  </div>
</div>
@endsection

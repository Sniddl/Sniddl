@extends('layouts.app')

@section('content')
  <?php $getCommunity = \App\Community::where('url','=',Request::segment(2))->first()?>
{{--$getCommunity gets the relevant information depending on the URL entered.--}}
{{--$owner gets the relevant information on the owner of the community.--}}

<div class="container">
  <div class="row">
{{--Left column--}}
      <div class="col-sm-6">
        <img class="img-circle" height="80px" style ="margin-right:10px;" src="{{$getCommunity->avatar}}"/>
        <h3 style="color:#0d0d0d;">{{$getCommunity->name}}</h3>
        <p style="color:#a8a8a8; padding-top:5px;"><b style="padding-right:10px;">URL</b> sniddl.com/c/{{$getCommunity -> url}}</p> <br>
        <hr>
        <h3 style="text-align:center; color:#529bd5;">Staff</h3>
        <h4><img class="img-circle" height="50px" style ="margin-right:10px; background-color:#{{$owner->color}}; " src="{{ $owner->avatar }}"/>{{$owner->username}}</h4>
        <hr>
        <h3 style="text-align:center; color:#529bd5;">Members</h3>
      </div>
{{--Right column--}}
      <div class="col-sm-6">
        <p style="float:right; font-size:11pt; color:#a8a8a8; padding-top:27px;">{{$getCommunity->desc}}</p>
      </div>
  </div>
</div>
@endsection

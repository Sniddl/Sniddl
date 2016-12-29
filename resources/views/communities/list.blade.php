@extends('layouts.app')

@section('content')
<div class="container">
  <h5>
    Currently there 
    @if($communities->count() == 0) are
    @elseif($communities->count() == 1) is
    @else($communities->count() > 1) are
    @endif
    {{$communities->count()}}
    @if($communities->count() == 0) communities
    @elseif($communities->count() == 1) community
    @else($communities->count() > 1) communities
    @endif
    on Sniddl.
  </h5>
  <a href="/create" class="createcommunity">create</a>
  <div class="list-group">
    @foreach($communities as $c)
      <a href="/c/{{$c->url}}" class="list-group-item list-group-item-action">
        <h5 class="list-group-item-heading">{{$c->name}} <small style="float:right; color:#909090;">/c/{{$c->url}}</small></h5>
        <p class="list-group-item-text">{{$c->description}}</p>
      </a>
    @endforeach
  </div>
</div>


@endsection

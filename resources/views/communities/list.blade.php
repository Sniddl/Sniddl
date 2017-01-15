@extends('layouts.app')

@section('content')
<div id="community-list" class="container">
  <h5>
    Currently there
    @if($communities->count() != 1) are
    @else is
    @endif
    {{$communities->count()}}
    @if($communities->count() != 1) communities
    @else community
    @endif
    on Sniddl.
  </h5>
  <a href="/create" class="createcommunity">create</a>
  <hr>
  @if($OwnerOf->count() > 0)
  <h4>Communities you are a part of</h4>
  @foreach($OwnerOf as $OwnerOf)
  <a href="/c/{{$OwnerOf->url}}" class="list-group-item list-group-item-action">
    <h5 class="list-group-item-heading">{{$OwnerOf->name}} <small style="float:right; color:#909090;">/c/{{$OwnerOf->url}}</small></h5>
    <p class="list-group-item-text">{{$OwnerOf->description}}</p>
  </a>
  @endforeach
  <hr>
  @endif
  <h4>All communities on Sniddl</h4>
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

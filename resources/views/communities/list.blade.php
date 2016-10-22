@extends('layouts.app')

@section('content')
<div class="container">
  <h5>Currently there are {{$communities->count()}} communities on Sniddl.</h5>
  <div class="list-group">
    @foreach($communities as $c)
      <a href="/c/{{$c->url}}" class="list-group-item list-group-item-action">
        <h5 class="list-group-item-heading">{{$c->name}} <small>/c/{{$c->url}}</small></h5>
        <p class="list-group-item-text">{{$c->description}}</p>
      </a>
    @endforeach
  </div>
</div>


@endsection

@extends('layouts.app')

@section('content')
<div id="community-list">
<div class="c-6 o-3">
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
  <hr>

  <!-- @if($OwnerOf->count() > 0)
  @foreach($OwnerOf as $OwnerOf)
  <a href="/c/{{$OwnerOf->url}}" class="list-group-item list-group-item-action">
    <h5 class="list-group-item-heading">{{$OwnerOf->name}} <small style="float:right; color:#909090;">/c/{{$OwnerOf->url}}</small></h5>
    <p class="list-group-item-text">{{$OwnerOf->description}}</p>
  </a>
  @endforeach
  <hr>
  @endif

  <div class="list-group">
    @foreach($communities as $c)
      <a href="/c/{{$c->url}}" class="list-group-item list-group-item-action">
        <h5 class="list-group-item-heading">{{$c->name}} <small style="float:right; color:#909090;">/c/{{$c->url}}</small></h5>
        <p class="list-group-item-text">{{$c->description}}</p>
      </a>
    @endforeach
  </div> -->
  <table class="communities-list fullwidth">
    <thead>
      <tr>
        <th>Name</th>
        <th>Owner</th>
        <th>Members</th>
        <th>URL</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($communities as $c)
      <tr>
        <td>{{$c->name}}</td>
        <td>*Owner Name*</td>
        <td>*Member No°*</td>
        <td>{{$c->url}}</td>
        <td><a class="button button-primary" href="/c/{{$c->url}}">View</a></td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
</div>

@endsection

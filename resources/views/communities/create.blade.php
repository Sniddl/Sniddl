@extends('layouts.app')

@section('content')
@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div id="create-community" class="container">
  <div class="row">
    <div class="col-sm-6 offset-sm-3">
      <form method="POST" action="/create/c" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
          <label for="c-communityname">Name for you community</label>
          <input name="createcommunityname" type="text" class="form-control" id="createcommunityname" placeholder="Name" autofocus>
        </div>
        <div class="form-group">
          <label for="c-communitydescription">What your community is about</label>
          <input name="createcommunitydescription" type="text" class="form-control" id="createcommunitydescription" placeholder="Description">
        </div>
        <div class="form-group">
          <label for="c-communitydescription">Enter a url suffix for your community <span style="color:#a4a4a4; padding-left:40px;">sniddl.com/c/<span id="comm_url_example" style="color: #2a2a2a;"></span></label>
          <input name="createcommunityurl" type="text" class="form-control" id="createcommunityurl" placeholder="Example: Sniddl">
        </div>
        <div class="form-group" style="padding-top:20px">
          <label for="c-communityavatar">Avatar upload</label>
          <input name="createcommunityavatar" type="file" id="createcommunityavatar">
          <p class="help-block">Upload an avatar for your community!</p>
        </div>
        {{ csrf_field() }}
        <button style="border:1px solid #a7a7a7; background-color:#e2e2e2; float:right; cursor:pointer;"><i class="material-icons" style="color:#00d467;">Create</i></button>
      </form>
    </div>
    <div class="col-sm-3"></div>
  </div>
</div>
@endsection

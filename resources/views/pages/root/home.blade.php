@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>

    <div class="row">
      <form class="" action="/post" method="POST">
        {{csrf_field()}}
        <textarea name="text" rows="4" cols="80"></textarea>
        <input type="submit"  value="Post">
      </form>
    </div>
</div>

@include('pages.posts.index')
@endsection

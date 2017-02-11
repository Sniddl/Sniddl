@extends('layouts.app')

@section('content')
<div class="col col-lg-8 offset-lg-2">
  <form class="ui form" action="/createJSON" method="post">
    {{csrf_field()}}
    <div class="field">
      <label>URL</label>
      <input type="text" name="url" placeholder="http://api.mysite.com/get/users">
    </div>

    <div class="field">
      <label>Name of Query</label>
      <input type="text" name="name" placeholder="mysite_users">
    </div>

    <div class="field">
      <label>JSON</label>
      <textarea name="json" placeholder='Any additional JSON you might need. Like auth tokens.

{
    "_token": "_abcdefg1234",
    "_secret": "itsasecret"
}'
       ></textarea>
    </div>

    <button type="submit" class="ui primary button">
      Create
    </button>
  </form>

</div>

@endsection

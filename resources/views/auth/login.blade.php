@extends('auth.index')

@section('forms')
<div class="login">
  <h1>Sign In</h1>
  <form class="ui form" role="form" method="POST" action="{{ url('/login') }}">
    {{ csrf_field() }}
    <div class="field">
      <label>Username</label>
      <input type="text" name="first-name" placeholder="Enter your username">
    </div>
    <div class="field">
      <label>Password</label>
      <input type="password" name="last-name" placeholder="Enter your password">
    </div>
    <button class="tiny ui button" type="submit">Submit</button>
  </form>
</div>
@endsection

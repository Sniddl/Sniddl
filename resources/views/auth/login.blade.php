@extends('auth.index')

@section('forms')
<div class="welcome-form login">
  <h1>Sign In</h1>
  <form class="ui form" role="form" method="POST" action="{{ url('/login') }}">
    {{ csrf_field() }}
    <div class="field">
      <label>Email</label>
      <input type="text" name="email" placeholder="Enter your email">
    </div>
    <div class="field">
      <label>Password</label>
      <input type="password" name="password" placeholder="Enter your password">
    </div>
    <div class="inline fields">
      <div class="field"><button class="tiny ui button" type="submit">Submit</button></div>
      <div class="field"><a href="/register">Don't have an account?</a></div>
    </div>
  </form>
</div>
@endsection

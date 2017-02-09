@extends('auth.index')

@section('forms')

<div class="welcome-form register">
  <h1>Sign Up</h1>
  <form class="ui form" role="form" method="POST" action="{{ url('/login') }}">
    {{ csrf_field() }}
    <div class="field">
      <label>Name</label>
      <input type="text" name="first-name" placeholder="Enter your name">
    </div>
    <div class="field">
      <label>Username</label>
      <input type="password" name="last-name" placeholder="Enter a username">
    </div>
    <div class="field">
      <label>Email</label>
      <input type="password" name="last-name" placeholder="Enter an email">
    </div>
    <div class="field">
      <label>Password</label>
      <input type="password" name="last-name" placeholder="Enter a password">
    </div>
    <div class="field">
      <label>Confirm password</label>
      <input type="password" name="last-name" placeholder="Confirm your password">
    </div>
    <div class="inline fields">
      <div class="field"><button class="tiny ui button" type="submit">Register</button></div>
      <div class="field"><a href="/login">Already have an account?</a></div>
    </div>
  </form>
</div>

@endsection

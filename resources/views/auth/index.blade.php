@extends('layouts.app')

@section('content')

<style media="screen">
  #left-panel{
    position: fixed;
    top: 0;
    left: 0;
    background: rgb(86, 193, 173);
  }
  #right-panel{
    position: fixed;
    top: 0;
    right: 0;
    background: rgb(33, 32, 47);
    color: white !important;
  }
</style>


<div class="container">
  <div class="row">
    <div id="left-panel" class="screen-height col-md-6"></div>
    <div id="right-panel" class="screen-height col-md-6">
      <div class="links">
        <a href="/login">Login</a>
        <a href="/register">Sign Up</a>
      </div>
      @yield('forms')
    </div>
  </div>
</div>
@endsection

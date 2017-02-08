@extends('layouts.app')

@section('content')

<style media="screen">
  #left-panel{
    position: fixed;
    top: 0;
    left: 0;
    background: #63d5c4;
  }
  #right-panel{
    position: fixed;
    top: 0;
    right: 0;
    background: #282a3a;
    color: white !important;
  }
</style>


<div class="container">
  <div class="row">
    <div id="left-panel" class="screen-height col-md-5"><img src="/uploads/sniddl150.png"></img></div>
    <div id="right-panel" class="screen-height col-md-7">
      @yield('forms')
    </div>
  </div>
</div>
@endsection

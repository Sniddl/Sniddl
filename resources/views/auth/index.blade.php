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

<div class="welcome container">
  <div class="row">
    <div id="left-panel" class="screen-height col-md-5"><img src="/uploads/sniddl200.png"></img></div>
    <div id="right-panel" class="screen-height col-md-7">
      <ul class="welcome-tabs">
        <li class="tab-link current" data-tab="tab-1">Sign In</li>
        <p class="or-divide">OR</p>
        <li class="tab-link" data-tab="tab-2">Sign Up</li>
      </ul>
      <div id="tab-1" class="tab-content current">
        @include('auth.login')
      </div>

      <div id="tab-2" class="tab-content">
        @include('auth.register')
      </div>
    </div>
  </div>
</div>

<script>
$(document).ready(function(){
	$('ul.welcome-tabs li').click(function(){
		var tab_id = $(this).attr('data-tab');

		$('ul.welcome-tabs li').removeClass('current');
		$('.tab-content').removeClass('current');

		$(this).addClass('current');
		$("#"+tab_id).addClass('current');
	})
})
</script>
@endsection

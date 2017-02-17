@extends('layouts.app')

@section('content')


<div class="welcome container">
  <div class="row">
    <div id="left-panel" class="img-of-the-day screen-height col-md-5"
      style="background-image: url('/uploads/images/resources/potd.jpg')">
      <img src="/uploads/sniddl200.png"></img>
      <span class="artist-info">
        Photo by
        <a class="img-of-the-day-artist"  target="_blank">  </a>
        / <a href="https://unsplash.com">Unsplash</a>
      </span>
    </div>

    <div id="right-panel" class="screen-height col-md-7">
      <ul class="welcome-tabs">
        <li class="tab-link" data-tab="#tab-1">Sign In</li>
        <p class="or-divide">OR</p>
        <li class="tab-link" data-tab="#tab-2">Sign Up</li>
      </ul>
      <div id="tab-1" style="display: none;" class="tab-content">
        @include('auth.login')
      </div>

      <div id="tab-2" style="display: none;"  class="tab-content">
        @include('auth.register')
      </div>
    </div>
  </div>
</div>

<script>

$('document').ready(function(){
  if(base_url_is('login')){
    $('.tab-link:nth-of-type(1)').addClass('current');
    $('#tab-1').show();
  }else if(base_url_is('register')){
    $('.tab-link:nth-of-type(2)').addClass('current');
    $('#tab-2').show();
  }

  $('.tab-link').click(function(){
    var target = $(this).data('tab');
    $('.tab-content').removeClass('current').hide();
    $('.tab-link').removeClass('current');
    $(this).addClass('current');
    $(target).addClass('current').show();
  })
	// $('ul.welcome-tabs li').click(function(){
	// 	var tab_id = $(this).attr('data-tab');
  //
	// 	$('ul.welcome-tabs li').removeClass('current');
	// 	$('.tab-content').removeClass('current');
  //
	// 	$(this).addClass('current');
	// 	$("#"+tab_id).addClass('current');
	// })
})
</script>
@endsection

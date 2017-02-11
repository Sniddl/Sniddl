@extends('layouts.app')

@section('content')


<!-- <div class="img-of-the-day" style="width:400px; position: relative">
  <img style="width:100%">

</div> -->


<div class="container">
  <div class="row">
    <div id="left-panel" class="img-of-the-day screen-height col-md-5">
      <img src="/uploads/sniddl200.png"></img>
      <span class="artist-info">
        Photo by
        <a class="img-of-the-day-artist" target="_blank"></a>
        / <a href="https://unsplash.com">Unsplash</a>
      </span>
    </div>

    <div id="right-panel" class="screen-height col-md-7">
      @yield('forms')
    </div>
  </div>
</div>


@endsection

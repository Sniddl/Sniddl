<!DOCTYPE html>
<html lang="en">
@include('head')
<body id="app-layout" style="background: #ECEEEF;">
<link rel="stylesheet" href="/css/sniddl.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
@if(Auth::check())



<div class="navigation top">
  <div class="user-block">
    <img class="avatar" src="{{Auth::user()->avatar_url}}"></img>
    <div class="user-info">
      <div class="name">{{Auth::user()->display_name}}</div>
      <div class="small-text">
        <span class="status-color green"></span>
        <span class="status hide-sm">Online | </span>
        <span class="username">{{Auth::user()->username}}</span>
      </div>
    </div>
  </div>

  <a class="logo" href="/" style="cursor:pointer;z-index:200;"></a>
  <!-- <div class="logo"></div> -->

  <div class="icons">
    <form action="/toggleDarkness" method="post" id="theme-change-nav" class="nav-forms">
      {{ csrf_field() }}
    <a href="javascript:{}" onclick="document.getElementById('theme-change-nav').submit();" class="icons-container hide-sm">
      <i class="fa fa-moon-o"></i>
    </a>
    </form>
    <a href="/notifications" class="icons-container hide-sm">
      <i class="fa fa-bell"></i>
    </a>
    <a href="/u/{{ Auth::user()->username }}" class="icons-container hide-sm">
      <i class="fa fa-user"></i>
    </a>
    <a href="/communities" class="icons-container hide-sm">
      <i class="fa fa-users"></i>
    </a>
    <a href="" class="icons-container">
      <i class="fa fa-bars"></i>
    </a>
  </div>

</div>

<div class="navigation bottom show-sm">
  <div class="icons left">
    <a href="" class="icons-container show-sm">
      <i class="fa fa-moon-o"></i>
    </a>
    <a href="" class="icons-container show-sm">
      <i class="fa fa-bell"></i>
    </a>
  </div>

  <div class="icons center">
    <a href="" class="icons-container big show-sm">
      <i class="fa fa-plus"></i>
    </a>
  </div>

  <div class="icons right">
    <a href="" class="icons-container show-sm">
      <i class="fa fa-user"></i>
    </a>
    <a href="" class="icons-container show-sm">
      <i class="fa fa-users"></i>
    </a>
  </div>
</div>
<!--End of navigation-->
@endif
@yield('content')

@include('footer')
</body>
</html>

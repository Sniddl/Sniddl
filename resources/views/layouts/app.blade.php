<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
</head>
<body id="app-layout" >


@if(Auth::check())

    




    <nav class="navbar navbar-light bg-faded">
      <ul class="nav navbar-nav">
        <a class="navbar-brand" href="/">Sniddl</a>

          <div class="nav-left" >
              <li class="nav-item">
                <a class="nav-link" href="/communities" >Communities</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/sort/friends" >Friends</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">Notifications</a>
              </li>
          </div>

          <div class="nav-center">
              <li class="nav-item">
                <a class="nav-link" href="/communities">
                  <i class="fa fa-users" aria-hidden="true"></i>
                  <div class="nav-icon-text">Communities</div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/sort/friends">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <div class="nav-icon-text">Friends</div>
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#">
                  <i class="fa fa-bell" aria-hidden="true"></i>
                  <div class="nav-icon-text">Notifications</div>
                </a>
              </li>
          </div>


        <button type="button" class="btn btn-outline-secondary pull-nav-right" data-toggle="modal" data-target="#myModal">
          <i class="fa fa-pencil"></i> Post
        </button>
        <div class="dropdown pull-nav-right">
          <img class="avatar" src="{{ Auth::user()->avatar_url }}" style="background-color:#{{Auth::user()->avatar_bg_color}};" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"/>
          <div class="dropdown-menu drop-right" aria-labelledby="dropdownMenuButton">

            <a class="dropdown-item" href="/u/{{ Auth::user()->username }}"><i class="fa fa-btn fa-user"></i> View Profile</a>
            <a class="dropdown-item" href="/edit/profile"><i class="fa fa-btn fa-cog"></i> Edit Profile</a>
            <a class="dropdown-item" href="{{ url('/logout') }}"
                  onclick="event.preventDefault();
                           document.getElementById('logout-form').submit();">
                  <i class="fa fa-btn fa-sign-out"></i> Logout
            </a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                  {{ csrf_field() }}
            </form>
          </div>
        </div>
      </ul>
    </ul>
  </nav>
@endif


@yield('content')
@include('footer')
</body>
</html>

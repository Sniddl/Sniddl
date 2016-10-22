<!DOCTYPE html>
<html lang="en">
<head>
    @include('head')
</head>
<body id="app-layout" >
  <!--
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">


                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>


                <a class="navbar-brand" href="{{ url('/') }}">
                    Sniddl
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">

                <ul class="nav navbar-nav">
                    <li><a href="{{ url('/home') }}">Home</a></li>
                </ul>


                <ul class="nav navbar-nav navbar-right">

                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}">Login</a></li>
                        <li><a href="{{ url('/register') }}">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                Post <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu create-post" role="menu">
                                @include ('create-post')
                            </ul>
                        </li>

                        <li><a style="position:relative" href="/u/{{Auth::user()->username}}"><img class="img-circle" height="25px" width="25px" style="position:absolute; margin-top:-2px; background-color:#{{Auth::user()->color}};" src="{{ Auth::user()->avatar }}"/></a></li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="/u/{{ Auth::user()->username }}"><i class="fa fa-btn fa-user"></i>My Profile</a></li>
                                <li><a href="/edit/profile"><i class="fa fa-btn fa-cog"></i>Edit Profile</a></li>
                                <li>
                                  <a href="{{ url('/logout') }}"
                                      onclick="event.preventDefault();
                                               document.getElementById('logout-form').submit();">
                                      Logout
                                  </a>

                                  <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                      {{ csrf_field() }}
                                  </form>
                                </li>

                            </ul>
                        </li>

                    @endif
                </ul>
            </div>
        </div>
    </nav>

-->













<style media="screen">

</style>

<nav class="navbar  navbar-dark bg-inverse" style="margin-bottom: 20px;" >
  <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#navbar-header" aria-controls="navbar-header" style="color:white;">&#9776;</button>
    <div class="collapse navbar-toggleable-xs" id="navbar-header">
      <a class="navbar-brand" href="/" style="margin-right: 30px;">Sniddl</a>
              <ul class="nav navbar-nav" >

                <li class="nav-item">
                  <a class="nav-link" href="/communities">Communities</a><span class="sr-only"></span></a>
                </li>
                @if(Auth::check())
                  <li class="nav-item">
                    <a class="nav-link" href="/sort/friends">Friends</a><span class="sr-only">(current)</span></a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="#">Notifications</a><span class="sr-only"></span></a>
                  </li>
                @endif

              </ul>
              @if(Auth::check())
              <!-- Button trigger modal -->
              <button type="button" class="btn btn-outline-secondary pull-xs-right" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-pencil"></i> Post
              </button>
              @endif

              <!-- Modal -->
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel" style="color:darkgrey">Create a post</h4>
                    </div>
                    <div class="modal-body">
                      @include ('create-post')
                    </div>
                  </div>
                </div>
              </div>
              @if(Auth::check())
              <div class="dropdown pull-xs-right">
                <img class="avatar" src="{{ Auth::user()->avatar }}" style="background-color:#{{Auth::user()->color}};" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"/>
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
              @endif
    </div>
</nav>

    @yield('content')

    @include('footer')
</body>
</html>

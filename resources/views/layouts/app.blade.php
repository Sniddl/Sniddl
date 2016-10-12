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
  .navbar .avatar {
    background-color: rebeccapurple;
    border-radius: 10px;
    width: 38px;
    box-sizing: border-box;
  }
  .drop-right {
    left: auto;
    right: 0;
    margin-right: -15px;
  }
  .navbar .pull-xs-right {
    margin: 0 5px;
  }

  .navbar-nav {
    text-align: center;
  }.navbar-item {
    display: inline-block;
    float: none !important;
  }
  .card-icons > a {
    color: black;
    text-decoration: none;
    margin-right: 10px;
}.card-block {
    padding: 0.5rem 0;
}
p.card-text {
    margin: 10px 0;
    padding: 10px 1.25rem;
    border-top: 1px solid #ccc;
    border-bottom: 1px solid #ccc;
}
.card-item {
  padding: 0 1.25rem;
}
span.collapse.in {
    display: inline;
}
</style>

<nav class="navbar  navbar-dark bg-inverse" style="margin-bottom: 20px;" >
  <button class="navbar-toggler hidden-sm-up" type="button" data-toggle="collapse" data-target="#navbar-header" aria-controls="navbar-header" style="color:white;">&#9776;</button>
    <div class="collapse navbar-toggleable-xs" id="navbar-header">
      <a class="navbar-brand" href="/" style="margin-right: 30px;">Sniddl</a>
              <ul class="nav navbar-nav" >
                <li class="nav-item">
                  <a class="nav-link" href="/sort/friends">Friends</a><span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Communities</a><span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="#">Notifications</a><span class="sr-only"></span></a>
                </li>
              </ul>

              <!-- Button trigger modal -->
              <button type="button" class="btn btn-outline-secondary pull-xs-right" data-toggle="modal" data-target="#myModal">
                <i class="fa fa-pencil"></i> Post
              </button>

              <!-- Modal -->
              <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                      <h4 class="modal-title" id="myModalLabel">Create a post</h4>
                    </div>
                    <div class="modal-body">
                      @include ('create-post')
                    </div>
                  </div>
                </div>
              </div>

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
    </div>
</nav>

    @yield('content')

    <!-- JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>

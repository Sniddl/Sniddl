<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
</head>
<body>
  <div id="sniddl">
      @if(Auth::check())
          <!--Navigation-->
          <div class="navigation top">

            <div class="user-block">
              <div class="avatar"></div>
              <div class="user-info">
                <div class="name">{{Auth::user()->display_name}}</div>
                <div class="small-text">
                  <span class="status-color green"></span>
                  <span class="status hide-sm">Online | </span>
                  <span class="username">{{Auth::user()->username}}</span>
                </div>
              </div>
            </div>

            <div class="logo"></div>

            <div class="icons">
              <a href="" class="icons-container hide-sm">
                <i class="fa fa-moon-o"></i>
              </a>
              <a href="" class="icons-container hide-sm">
                <i class="fa fa-bell"></i>
              </a>
              <a href="" class="icons-container hide-sm">
                <i class="fa fa-user"></i>
              </a>
              <a href="" class="icons-container hide-sm">
                <i class="fa fa-users"></i>
              </a>
              <a href="" class="icons-container" data-toggle="#nav-dropdown">
                <i class="fa fa-bars"></i>
              </a>
            </div>

            <div id="nav-dropdown" class="dropdown" >
              <div class="card-item">
                <ul>
                  <li>
                        <a  v-href
                            data-href="/logout"
                            data-request="POST">
                            Logout
                        </a>
                   </li>
                </ul>
              </div>
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
      @endif


        <div id="content" style="margin-top:60px">
          @yield('content')
        </div>




  </div>
    @include('layouts.foot')
</body>
</html>

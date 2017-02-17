<!DOCTYPE html>
<html lang="en">
<head>
    @include('layouts.head')
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/semantic/semantic.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="/semantic/semantic.min.js"></script>
    <script type="text/javascript" src="/js/app.js"></script>

<style media="screen">
body{
  overflow: hidden !important;
}
.info {
  position: relative;
  display: inline-block;
  padding-left: 50px;
  width: 100%;
  box-sizing: border-box;
}

span.icon {
  position: relative;
  margin: 0 20px;
  height: 28px;
  line-height: 28px;
  cursor: pointer;

}
.icon .fa {
  left: -10px;
}

.right{
text-align: right;
float: right;
}

#nav-dropdown{
  position: absolute;
  right: 0;
  top: 34px;
  display: none;
}

.sidebar hr {
    border-color: rgba(255, 255, 255, 0.39);
    margin: -1px;
    outline: none;
    border-width: 1px;
    border-style: dashed;
}

.sidebar .item {
    text-align: left;
    padding-left: 30px !important;
    position: relative;
}
</style>

</head>

<body>
  <!-- <div id="sniddl"> -->
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
          <a href="" class="icons-container" data-toggle="#nav-dropdown" onclick="$('.ui.sidebar').sidebar('toggle');">
            <i class="fa fa-bars"></i>
          </a>
        </div>

        <!-- <div id="nav-dropdown" class="dropdown" >
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
        </div> -->

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



          <div class="ui sidebar right inverted vertical menu" style="padding-top:60px !important; ">
            <a class="item"
                  _action="/viewproasdfa"
                  _method="post">
              View Profile
            </a>

            <a class="item"
                  _action="/changethemasfasdf"
                  _method="post">
              Change Theme
            </a>

            <a class="item"
                  _action="/setsinasa">
              Settings
            </a>

            <a class="item"
                  _action="/logout"
                  _method="post">
              Logout
            </a>
          </div>
          <div class="pusher">


            <div id="content" style="margin-top:60px">
              @yield('content')
            </div>


          </div>
      @else
        <div id="content" style="margin-top:60px">
          @yield('content')
        </div>
      @endif







  <!-- </div> -->
    @include('layouts.foot')
</body>
</html>

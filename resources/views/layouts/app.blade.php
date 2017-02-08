<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="/css/app.css" rel="stylesheet">
    <link href="/semantic/semantic.min.css" rel="stylesheet">

    <script type="text/javascript" src="/semantic/semantic.min.js"></script>
    <style media="screen">






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


    </style>


    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>
  <form id="global-form"></form>


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
                        <a  data-ajax="true"
                            data-href="/post"
                            data-request="POST"
                            data-json='{"test": "test-value", "test2": "test2-value"}'>
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
      @yield('content')


    <!-- Scripts -->
    <script src="/js/app.js"></script>
    <script type="text/javascript">

    </script>
</body>
</html>

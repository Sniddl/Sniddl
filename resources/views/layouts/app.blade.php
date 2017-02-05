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


    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>
<body>



      @if(Auth::check())
          <!--Navigation-->
          <div class="navigation top">

          <div class="user-block">
            <div class="avatar"></div>
            <div class="user-info">
              <div class="name">Zeb</div>
              <div class="small-text">
                <span class="status-color green"></span>
                <span class="status hide-sm">Online | </span>
                <span class="username">ZebTheWizard</span>
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
      @endif
      @yield('content')
  

    <!-- Scripts -->
    <script src="/js/app.js"></script>
</body>
</html>

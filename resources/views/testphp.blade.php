@include('head')
<link rel="stylesheet" href="/css/sniddl-bones.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<body style="background: #ECEEEF;">



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

















  <div class="container" >
    <div class="row">
      <div class="card">
        <div class="body create-post-body">
          <img class="image" src="http://placehold.it/300x300"></img>
          <form class="" action="/create-post" method="post">
          <textarea name="text" class="fullwidth post-textarea" placeholder="Tell the world!" id="exampleMessage"></textarea>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="submit" value="post" style="float:right; color:#63b992;">
          </form>
        </div>
      </div>

      <!-- @include('showAllPosts') -->

    </div>
  </div>
</body>

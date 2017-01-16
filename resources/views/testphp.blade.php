@include('head')

<?php $items=['a','a','a','a','a','a','a','a','a'] ?>
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

















  <div class="container" >
    <div class="row">

@foreach($items as $item)


      <div class="card">
        <div class="header">
          <img class="image" src="http://placehold.it/300x300"></img>
            <div class="content">
              <div class="name">Zeb</div>
              <a class="username" href="http://google.com">@zebthewizard</a>
              <div class="username">+Sniddl</div>
              <div class="time">1 hour ago</div>
              <div class="icon"><i class="fa fa-ellipsis-h post-settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i></div>
            </div>
          </div>
        <div class="body">
            <span>Hey</span>
        </div>
        <div class="footer">
          <span class="icon repost"  >
            <i class="fa fa-retweet"></i> 100k
          </span>
          <span class="icon like"  >
            <i class="fa fa-heart"></i>100k
          </span>
          <span class="icon reply" >
            <i class="fa fa-reply"></i> 100k
          </span>
        </div>
      </div>
@endforeach

    </div>
  </div>
</body>

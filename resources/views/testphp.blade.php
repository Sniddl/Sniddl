



<?php for ($i=1; $i < 100; $i++): ?>
  <?php if ($i % 5 == 0 && $i % 3 == 0): ?>
    <p>Fizzbuzz</p>
  <?php elseif ($i % 3 == 0): ?>
    <p>Fizz</p>
  <?php elseif ($i % 5 == 0): ?>
    <p>Buzz</p>
  <?php else: ?>
    <p><?php echo $i ?></p>
  <?php endif; ?>
<?php endfor; ?>

<?php $items=['a'] ?>
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
        <form class="" action="index.html" method="post">
        <div class="header clear">
          <div class="user-block no-left">
            <div class="avatar"></div>
            <div class="user-info">
              <a href="#" class="name underline">Zeb</a>
              <div class="small-text">
                <a href="#" class="underline">ZebTheWizard</a>
                <a href="#" class="hide underline">/c/Sniddl </a>
              </div>
            </div>
          </div>
          <div class="other-info">
            <a href="" class="icons-container">
              <i class="fa fa-ellipsis-v"></i>
            </a>
          </div>
        </div>
        <div class="body">
          <span>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</span>
        </div>
        <div class="footer">

            <button class="icons-container">
              <i class="fa fa-retweet">
                <span class="text">10k</span>
              </i>
            </button>
            <button href="" class="icons-container">
              <i class="fa fa-heart">
                <span class="text">10k</span>
              </i>
            </button>
            <button href="" class="icons-container">
              <i class="fa fa-reply">
                <span class="text">10k</span>
              </i>
            </button>


        </div>
        </form>
      </div>






@endforeach

    </div>
  </div>
</body>

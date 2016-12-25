<style media="screen">
.card-img-top {
  border-top-right-radius: calc(0.25rem - 1px);
  border-top-left-radius: calc(0.25rem - 1px);
  width: 100%;
  box-sizing: initial;
  height: 120px;
  background-color: <?php echo $user->banner_bg_color?>;
  background-image: url('<?php echo $user->banner_url?>');
  background-position: center center;
  background-size: cover;
  position: relative;
  margin-bottom: 15px;
}
.card-img-top .avatar {
    width: 80px;
    border-radius: 100%;
    position: absolute;
    left: 50%;
    transform: translateX(-50%);
    bottom: -40px;
}

.card-block {
    padding: 10px 20px;
}
.card{
  padding: 0;
}
.info span {
  display: block;
}
.info .display_name {
    font-size: 24px;
    font-weight: 600;
}
.info .username {
    font-size: 12px;
}
</style>


<div class="card col-md-4 col-sm-6">
<div class="card-img-top">
  <a href="/u/{{$user->username}}">
    <img class="avatar" src="{{ $user->avatar_url }}" style="background-color:{{$user->avatar_bg_color}};" />
  </a>

</div>
<div class="card-block">
  <div class="info">
    <span class="display_name">{{$user->display_name}}</span>
    <span class="username">{{"@". $user->username}}</span>
  </div>
</div>
</div>

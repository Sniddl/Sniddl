@extends ('home')
@section('posts')


<div class="container-fluid">
<div class="row">


<!--⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯
  DECLARE GLOBAL VARIABLES
⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯-->

     <?php $user = \App\User::GetRequest('username', 2)->first()?>



<!--⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯
  DOES THE PROFILE BELONG TO THE AUTH::USER()
⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯-->





<style media="screen">
  .banner-img {
    height: 33vw;
    background-color: <?php echo $user->banner_bg_color ?>;
    background-image: url('<?php echo $user->banner_url ?>');
    background-position: center center;
    background-size: cover;
    position: relative;
    z-index: 1;
    top: -10px;
    left: 0;}
    .banner-img .avatar {
      position: absolute;
      height: 120px;
      width: 120px;
      background-position: center;
      background-size: contain;
      border-radius: 100%;
      bottom: -86px;
      left: 50px;
      z-index: 2}
    .banner-img .edit{
      font-size: 16px;
      background: rgba(0, 0, 0, 0.17);
      padding: 6px 10px;
      position: absolute;
      top: 0;
      right: 0;
      text-decoration: none;
      font-weight: 300;
      color: rgba(255, 255, 255, 0.72);}
    .sort-ul {
      background: rgba(255, 255, 255, 0.5);
      position: relative;
      top: -10px;
      width: 100%;
      z-index: 0;
      padding-left: 250px;
      margin-bottom: 40px;}
      .sort-ul .sort-li {
        cursor: pointer;
        box-sizing: border-box;
        right: 15px;
        position: relative;
        padding: 1px 15px 1px;
        border-bottom: 5px solid transparent;
        text-align: center;
        display: inline-block;
        text-decoration: none;
        bottom: -5px;}
        .sort-ul .sort-li:hover{
          border-bottom: 5px solid blue;}
        .sort-ul .sort-li .header {
          font-size: 10px;
          letter-spacing: 1px;
          display: block;
          text-transform: uppercase;
          color: grey;}
        .sort-ul .sort-li .number {
          font-size: 23px;}
    .sort-ul .friend-btn{
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      right: 50px;}
</style>

  <div class="banner-img col-lg-12">
    <img class="avatar" src="{{ $user->avatar_url }}" style="background-color:{{$user->avatar_bg_color}};" />
    @if ( Auth::check() )
      @if(Auth::user()->username == $user->username)
          <a href="/edit/profile" class="edit">
            <i class="fa fa-pencil" aria-hidden="true"></i>
          </a>
      @endif
    @endif
  </div>

  @if(Auth::check())

         <?php $friend = $user->AuthFriend()?>



      <div class="sort-ul">
        <a href="/u/{{$user->username}}" class="sort-li">
          <span class="header">Posts</span>
          <span class="number">{{$data['timeline']->count()}}</span>
        </a>
        <a href="/u/{{$user->username}}/following" class="sort-li">
          <span class="header">Following</span>
          <span class="number">{{$data['following']->count()}}</span>
        </a>
        <a href="/u/{{$user->username}}/followers" class="sort-li">
          <span class="header">Followers</span>
          <span class="number">{{$data['followers']->count()}}</span>
        </a>
        <a href="/u/{{$user->username}}/friends" class="sort-li">
          <span class="header">Friends</span>
          <span class="number">{{$data['friends']->count()}}</span>
        </a>
        @if(Auth::user()->username != $user->username)
            @if($friend)
              <a href="/friend/{{$user->id}}" class="friend-btn btn btn-danger">Remove friend</a>
            @else
              <a href="/friend/{{$user->id}}" class="friend-btn btn btn-primary">Add friend</a>
            @endif
        @endif
      </div>
  @else
  <div class="sort-ul">
    <a href="/login" class="sort-li">
      <span class="header">Posts</span>
      <span class="number">{{$data['timeline']->count()}}</span>
    </a>
    <a href="/login" class="sort-li">
      <span class="header">Following</span>
      <span class="number">{{$data['following']->count()}}</span>
    </a>
    <a href="/login" class="sort-li">
      <span class="header">Followers</span>
      <span class="number">{{$data['followers']->count()}}</span>
    </a>
    <a href="/login" class="sort-li">
      <span class="header">Friends</span>
      <span class="number">{{$data['friends']->count()}}</span>
    </a>

  </div>
  @endif

</div>
</div>









<!--⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯
  Stats
⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯-->






<!--⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯
  Show lists here
⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯-->

  <div class="container">
    <div class="row">
      @yield('list')
    </div>
  </div>


  @yield('edit')




@endsection

@extends ('home')
@section('posts')
<?php $user = \App\User::GetRequest('username', 2)->first()?>

<style media="screen">
.banner-img{
  background-color: <?php echo $user->banner_bg_color ?>;
  background-image: url('<?php echo $user->banner_url ?>');
}
</style>

<div class="banner-img c-12">
  <img class="avatar" src="{{ $user->avatar_url }}" style="background-color:{{$user->avatar_bg_color}};" />
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


  @yield('list')


  @yield('edit')


@endsection

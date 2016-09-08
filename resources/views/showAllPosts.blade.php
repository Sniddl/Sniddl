@extends ('welcome')
@section('posts')


<div class="container">

  @if(Request::is('sort/friends'))
    <h3>Posts by Friends</h3>
    <a href="/">Show all posts</a>
  @else
    <h3>All Posts</h3>
    <a href="/sort/friends">Only show posts by friends</a>
  @endif


  @foreach ($posts as $post)

    <div class="thumbnail">
      {{ $post->created }}
      <br/>
      <a href="/u/{{ $post->User->username }}">{{ $post->User->name }}</a> {{'@'.$post->User->username}}
      <br/>
      <a href="/like/{{ $post->id }}">Like {{ $post->likes()->count() }}</a>
      <a href="/repost/{{ $post->id }}">Repost {{ $post->reposts()->count() }}</a>
      <p>
        {!! nl2br(e($post->text)) !!}
      </p>
      @if(Auth::check())
          @if (Auth::user()->username == $post->user)
              <br>
              <a href="/delete/{{$post->id}}">delete post</a>
          @else
              <br>

              @if (!\App\Friend::where('user_id','=',$post->user_id)->where('user','=',Auth::user()->username)->exists())
                  <a href="/friend/{{$post->user_id}}">Add friend</a>
              @else
                  <a href="/friend/{{$post->user_id}}">Remove Friend</a>
              @endif
          @endif
      @endif

    </div>
  @endforeach
</div>
@endsection

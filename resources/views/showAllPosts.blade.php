@extends ('home')
@section('posts')


<div class="container">

<!--⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯
  SHOW SORTING OPTIONS
⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯-->
      @if(Request::is('sort/friends'))
        <h3>Posts by Friends</h3>
        <a href="/">Show all posts</a>
      @else
        <h3>All Posts</h3>
        @if(Auth::check())
          <a href="/sort/friends">Only show posts by friends</a>
        @else
          <a href="/signup">Only show posts by friends</a>
        @endif

      @endif


<!--⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯
  SHOW ALL POSTS & REPOSTS ON SITE
⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯⎯-->
      @foreach ($timeline as $timeline)
        <?php $post = $timeline->post; ?> 

        <div class="thumbnail">
          <div class="">
            {{ $post->created_at }}
            @if($timeline->is_repost)
                  <strong>Reposted by {{$timeline->added_by}}</strong>
            @endif
          </div>

          <div class="">
            <img class="img-circle" height="50px" width="50px" style ="margin-right:10px; background-color:#{{$post->User->color}};" src="{{ $post->User->avatar }}"/>
            <a href="/u/{{ $post->User->username }}">{{ $post->User->name }}</a> {{'@'.$post->User->username}}
          </div>



          <div class="post-text" >
            {!! parse_post( nl2br(e($post->text)) ) !!}
          </div>

          <div class="">
            @if(Auth::check())
                @if (Auth::user()->username == $post->user)
                    <br>
                    <form class="" action="/delete/post/{{$post->id}}" method="post">
                      {{ csrf_field() }}
                      <input type="submit" name="name" value="Delete Post" class='btn btn-danger'>
                    </form>
                @else
                    <br>

                    @if (!\App\Friend::where('user_id','=',$post->user_id)->where('follower','=',Auth::user()->username)->exists())
                        <a href="/friend/{{$post->user_id}}">Add friend</a>
                    @else
                        <a href="/friend/{{$post->user_id}}">Remove Friend</a>
                    @endif
                @endif
            @endif

          </div>

          @if(Auth::check())
            <div class="">
              <a href="/like/{{ $post->id }}">Like {{ $post->likes()->count() }}</a>
              <a href="/repost/{{ $post->id }}">Repost {{ $post->reposts()->count() }}</a>
            </div>
          @else
          <div class="">
            <a href="/signup">Like {{ $post->likes()->count() }}</a>
            <a href="/signup">Repost {{ $post->reposts()->count() }}</a>
          </div>
          @endif

        </div>
      @endforeach


  </div>
  @endsection

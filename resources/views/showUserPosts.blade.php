@extends ('welcome')
@section('posts')


<div class="container">
   {{-- */ $user = \App\User::where('username','=',Request::segment(2))->first(); /* --}}


  <h3><img class="img-circle" height="50px" style ="margin-right:10px;" src="{{ $user->avatar }}"/>{{ $user->name }}'s Profile</h3>


  @if(Auth::check() && Auth::user()->username != $user->username)
      {{-- */
        $friend = \App\Friend::where('user_id','=', $user->id )->where('user', '=', Auth::user()->username);
      /* --}}
      @if(!$friend->exists())
        <a href="/friend/{{$user->id}}">Add friend</a>
      @else
        <a href="/friend/{{$user->id}}">Remove Friend</a>
      @endif
  @elseif(Auth::check() && Auth::user()->username != $user->username)
      <a href="/edit/profile">Edit Profile</a>
  @endif


  <br><br><br><br>


  @foreach ($timeline as $timeline)
  {{--*/ $post = $timeline->post; /* --}}

    <div class="thumbnail">
          <div>
            {{ $post->created_at }}
            @if($post->user != Request::segment(2))
                  <strong>{{$user->name}} reposted</strong>
            @endif
          </div>

          <div>
            <img class="img-circle" height="50px" style ="margin-right:10px;" src="{{ $post->User->avatar }}"/>
            <a href="/u/{{ $post->user }}">{{ $post->User->name }}</a>
          </div>

          <div>
            {!! nl2br(e($post->text)) !!}
          </div>

          <div class="">
            <a href="/like/{{ $post->id }}">Like {{ $post->likes()->count() }}</a>
            <a href="/repost/{{ $post->id }}">Repost {{ $post->reposts()->count() }}</a>
          </div>


    </div>

  @endforeach

  @yield('edit')



</div>
@endsection

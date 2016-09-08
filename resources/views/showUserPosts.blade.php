@extends ('welcome')
@section('posts')


<div class="container">
  <h3>{{ \App\User::where('username','=',Request::segment(2))->first()->name }}</h3>

  @foreach ($posts as $post)

    <div class="thumbnail">
          <div>
            {{ $post->created }}
            @if($post->user != Request::segment(2))
                  <strong>Reposted by {{Request::segment(2)}}</strong>
            @endif
          </div>
          <div>
            Posted by: <a href="/u/{{ $post->user }}">{{ $post->user }}</a>
          </div>
          <div>
            {!! nl2br(e($post->text)) !!}
          </div>
          <a href="/like/{{ $post->id }}">Like {{ $post->likes()->count() }}</a>
          <a href="/repost/{{ $post->id }}">Repost {{ $post->reposts()->count() }}</a>

    </div>

  @endforeach



</div>
@endsection

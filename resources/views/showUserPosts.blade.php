@extends ('welcome')
@section('posts')


<div class="container">
  <h3>{{$data['username']}}</h3>
  @foreach ($data['posts'] as $post)

    <div class="thumbnail">
      {{ $post->created }}
      <br/>
      <a href="/u/{{ $post->user }}">{{ $post->user }}</a>
      <br/>
      <a href="/like/{{ $post->id }}">Like {{ $post->likes()->count() }}</a>
      <a href="/repost/{{ $post->id }}">Repost {{ $post->reposts()->count() }}</a>
      {{ $post->text }}
    </div>

  @endforeach



  @foreach ($data['reposts'] as $repost)

    <div class="thumbnail">
      {{ $repost->post->created }}
      <br/>
      <a href="/u/{{ $repost->post->user }}">{{ $repost->post->user }}</a>
      <br/>
      <a href="/like/{{ $repost->post->id }}">Like {{ $repost->post->likes()->count() }}</a>
      <a href="/repost/{{ $repost->post->id }}">Repost {{ $repost->post->reposts()->count() }}</a>
      {{ $repost->post->text }}
    </div>

  @endforeach

</div>
@endsection

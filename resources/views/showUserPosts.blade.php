@extends ('welcome')
@section('posts')


<div class="container">
  <h3>{{Request::segment(2)}}</h3>
  
  @foreach ($posts as $post)

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



</div>
@endsection

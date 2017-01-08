@extends ('home')
@section('posts')

<div class="col-lg-6 col-md-10 offset-lg-3 offset-md-1" >
  @foreach(Auth::user()->notifications as $n)
    <?php
      $timeline = \App\Timeline::withTrashed()->find($n->data['timeline']['id']);
      $post = $timeline->post;
    ?>
    @if( !$post->ReplyTo()->TimelineOP()->trashed() )
    <div class="card post-block card-block" data-link="{{url('/post/'.$post->ReplyTo()->TimelineOP()->id)}}">
      @include('layouts.post')
    </div>
    @endif

  @endforeach
</div>


@endsection

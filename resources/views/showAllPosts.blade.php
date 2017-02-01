@extends ('home')
@section('posts')
<div class="c-6 o-3" >
  <div class="timeline-info" data-last-post-update="{{ \Carbon\Carbon::now()->toDateTimeString() }}"></div>
      <div class="card">
        <div class="body create-post-body">
          <form class="" action="/create-post" method="post">
          <textarea name="text" class="fullwidth post-textarea" placeholder="Tell the world!" id="exampleMessage"></textarea>
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input type="submit" value="post" style="float:right; color:#63b992;">
          </form>
        </div>
      </div>
      @if ($timeline->count() == 0)
          @include('layouts.nothingToShow')
      @else
      @foreach ($timeline as $timeline)
        <?php $post = $timeline->post; ?>
      <div class="card" data-link="{{url('/post/'.$timeline->id)}}">

        @include('layouts.post')

      </div>
      @endforeach
      @endif
</div>
@endsection

@extends ('home')
@section('posts')




      <div class="col-lg-6 col-md-10 offset-lg-3 offset-md-1" >
        <div class="timeline-info" data-last-post-update="{{ \Carbon\Carbon::now()->toDateTimeString() }}"></div>
            <div class="card card-block" style="display:none">
              <div class="card-text card-item" style="text-align:center">
                <a href="#" id="new-post-event" onclick="location.reload()"></a>
              </div>
            </div>
            @if ($timeline->count() == 0)
              @include('layouts.nothingToShow')
            @endif
            @foreach ($timeline as $timeline)
              <!-- Make variable for the posts you are referencing. -->
              <?php $post = $timeline->post; ?>
              <div class="card post-block card-block" data-link="{{url('/post/'.$timeline->id)}}">
                @include('layouts.post')
              </div>
            @endforeach
      </div>

      <script src="/js/layouts/post.js" charset="utf-8"></script>
      @include('layouts.popups.post-link')





  @endsection

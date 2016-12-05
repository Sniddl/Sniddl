@extends ('home')
@section('posts')
<div class="col-lg-6 col-md-10 offset-lg-3 offset-md-1" >
  <div class="timeline-info" data-last-post-update="{{ \Carbon\Carbon::now()->toDateTimeString() }}"></div>
      <div class="card card-block" style="display:none">
        <div class="card-text card-item" style="text-align:center">
          <a href="#" id="new-events" onclick="location.reload()"></a>
        </div>
      </div>

        <!-- Make variable for the posts you are referencing. -->
        <?php $post = $timeline->post; ?>
        @include('layouts.post')
        @if( Request::segment(1) == "post")

          <?php
            $post = $timeline->post()->first();
            $replies = $post->replies();
           ?>

            <div class="reply-header">
              How people reacted...
            </div>
             @foreach($replies as $reply)
               <?php $post = $reply->post() ?>
               @include('layouts.post')
             @endforeach

        @endif

</div>
<script src="/js/layouts/post.js" charset="utf-8"></script>
@include('layouts.popups.post-link')
@endsection

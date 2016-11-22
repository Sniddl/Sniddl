@extends ('profile.index')
@section('list')



  <div class="col-lg-8 col-md-10 offset-lg-2 offset-md-1" >
    @foreach ($data['timeline'] as $timeline)
      <!-- Make variable for the posts you are referencing. -->
      <?php $post = $timeline->post_id; ?>
      @include('layouts.post')
    @endforeach
  </div>
  @include('layouts.popups.post-link')
  <script src="/js/layouts/post.js" charset="utf-8"></script>

@endsection

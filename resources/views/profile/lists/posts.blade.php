@extends ('profile.index')
@section('list')



  <div class="c-6 o-3" >
    @if($data['timeline']->count() > 0)
      @foreach ($data['timeline'] as $timeline)
        <!-- Make variable for the posts you are referencing. -->
        <?php $post = $timeline->post; ?>
        <div class="card post-block card-block" data-link="{{url('/post/'.$timeline->id)}}">
          @include('layouts.post')
        </div>
      @endforeach
    @else
      @include('layouts.nothingToShow')
    @endif
  </div>
  <script src="/js/layouts/post.js" charset="utf-8"></script>

@endsection

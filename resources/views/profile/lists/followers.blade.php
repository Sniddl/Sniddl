

@extends ('profile.index')
@section('list')
  @if($data['followers']->count() > 0)
    @foreach ($data['followers'] as $instance)
      <?php $user = $instance->follower();?>
      @include('layouts.userCard')
    @endforeach
  @else
    @include('layouts.nothingToShow')
  @endif

@endsection

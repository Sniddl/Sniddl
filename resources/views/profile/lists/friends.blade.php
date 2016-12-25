
@extends ('profile.index')
@section('list')

  @if($data['friends']->count() > 0)
    @foreach ($data['friends'] as $instance)
      <?php $user = $instance->user_being_followed();?>
      @include('layouts.userCard')
    @endforeach
  @else
    @include('layouts.nothingToShow')
  @endif

@endsection

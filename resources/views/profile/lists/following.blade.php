@extends ('profile.index')
@section('list')




    @if($data['following']->count() > 0)
      @foreach ($data['following'] as $instance)
        <?php $user = $instance->user_being_followed();?>
        @include('layouts.userCard')
      @endforeach
    @else
      @include('layouts.nothingToShow')
    @endif


@endsection

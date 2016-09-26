@extends ('profile.index')
@section('list')
<div class="friends List">

    <ul class="list-group">
      @foreach ($data['following'] as $following)
        <li class="list-group-item">
          <h5>
            <a href="/u/{{$following->User->username}}">{{$following->User->name}}</a>
            <small>{{'@'.$following->User->username}}
              @if(!\App\Friend::where('user_id','=', $following->User->id )->where('user', '=', Auth::user()->username)->exists())
                <a href="/friend/{{$following->User->id}}">Add friend</a>
              @else
                <a href="/friend/{{$following->User->id}}">Remove Friend</a>
              @endif
            </small>
          </h5>

        </li>
      @endforeach
    </ul>

</div>
@endsection

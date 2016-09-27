@extends ('profile.index')
@section('list')
<div class="friends List">

    <ul class="list-group">
      @foreach ($data['followers'] as $follower)
        <li class="list-group-item">
          <h5>
            <a href="/u/{{$follower->user}}">{{$follower->user}}</a>
            <small>{{'@'.$follower->user}}
              @if($follower->user != Auth::user()->username)
                  {{--*/ $user = \App\User::where('username', '=', $follower->user)->first() /*--}}
                  @if(!\App\Friend::where('user_id','=', $user->id )->where('user', '=', Auth::user()->username)->exists())
                    <a href="/friend/{{$follower->User->id}}">Add friend</a>
                  @else
                    <a href="/friend/{{$follower->User->id}}">Remove Friend</a>
                  @endif
              @endif
            </small>
          </h5>

        </li>
      @endforeach
    </ul>

</div>
@endsection

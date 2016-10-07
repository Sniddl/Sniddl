
@extends ('profile.index')
@section('list')

<div class="friends List">
    <ul class="list-group">
      @foreach ($data['friends'] as $friend)

        <?$user = \App\User::where('username','=', $friend->User->username)->first();
        $user2 = \App\Friend::where('user_id','=', $user->id )->where('follower', '=', Auth::user()->username)?>


        <li class="list-group-item">
          <h5>
            <a href="/u/{{$friend->User->username}}">{{$friend->User->name}}</a>
            <small>{{'@'.$friend->User->username}}
              @if ( $friend->User->username != Auth::user()->username)
                @if($user2->exists())
                  <a href="/friend/{{$friend->User->id}}">Remove Friend</a>
                @else
                  <a href="/friend/{{$friend->User->id}}">Add friend</a>
                @endif
              @endif
            </small>
          </h5>

        </li>
      @endforeach
    </ul>

</div>
@endsection

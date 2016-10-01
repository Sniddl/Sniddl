

@extends ('profile.index')
@section('list')
<div class="friends List">

    <ul class="list-group">
      @foreach ($data['followers'] as $follower)
      <?//V A R I A B L E S

        $user = \App\User::where('username', '=', $follower->follower)->first();
        $friend = \App\Friend::where('user_id','=', $user->id )->where('follower', '=', Auth::user()->username);

      ?>
        <li class="list-group-item">
          <h5>
            <a href="/u/{{$user->username}}">{{$user->name}}</a>
            <small>{{'@'.$user->username}}
              @if($follower->follower != Auth::user()->username)
                  @if($friend->exists())
                    <a href="/friend/{{$user->id}}">Remove Friend</a>
                  @else
                    <a href="/friend/{{$user->id}}">Add friend</a>
                  @endif
              @endif

            </small>
          </h5>

        </li>
      @endforeach
    </ul>

</div>
@endsection

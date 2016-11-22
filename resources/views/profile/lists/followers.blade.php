

@extends ('profile.index')
@section('list')
<div class="friends List">

    <ul class="list-group">
      @foreach ($data['followers'] as $follower)

        <?php $user = \App\User::find($follower->follower_id);
        $friend = $user->AuthFriend()?>

        <li class="list-group-item">
          <h5>
            <a href="/u/{{$user->username}}">{{$user->display_name}}</a>
            <small>{{'@'.$user->username}}
              @if($follower->follower_id != Auth::user()->id)
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

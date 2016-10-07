@extends ('profile.index')
@section('list')
    <h4>Posts & Reposts</h4>
    @foreach ($data['timeline'] as $timeline)
    <? $post = $timeline->post; ?>

      <div class="thumbnail">
            <div>
              {{ $post->created_at }}
              @if($post->user != Request::segment(2))
                    <strong>{{$user->name}} reposted</strong>
              @endif
            </div>

            <div>
              <img class="img-circle" height="50px" style ="margin-right:10px; background-color:#{{$post->User->color}};" src="{{ $post->User->avatar }}"/>
              <a href="/u/{{ $post->user }}">{{ $post->User->name }}</a>
            </div>

            <div>
              {!!  parse_post( nl2br(e($post->text)) ) !!}
            </div>

            @if(Auth::check())
              @if (Auth::user()->username == $post->user)
                <br>
                <form class="" action="/delete/post/{{$post->id}}" method="post">
                  {{ csrf_field() }}
                  <input type="submit" name="name" value="Delete Post" class='btn btn-danger'>
                </form>
              @endif
              <div class="">
                <a href="/like/{{ $post->id }}">Like {{ $post->likes()->count() }}</a>
                <a href="/repost/{{ $post->id }}">Repost {{ $post->reposts()->count() }}</a>
              </div>
            @else
              <div class="">
                <a href="/signup">Like {{ $post->likes()->count() }}</a>
                <a href="/signup">Repost {{ $post->reposts()->count() }}</a>
              </div>
            @endif


      </div>

    @endforeach

@endsection

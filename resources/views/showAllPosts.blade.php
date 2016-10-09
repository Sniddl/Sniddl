@extends ('home')
@section('posts')


<div class="container">









<div class="col-lg-6 col-md-10 offset-lg-3 offset-md-1" >
      @foreach ($timeline as $timeline)
        <?php $post = $timeline->post; ?>
          <!--<img class="card-img-top" src="..." alt="Card image cap">-->

            <div class="card card-block">
              <div class="card-text card-item">
                <a href="/u/{{ $post->User->username }}">{{ $post->User->name }}</a>
                <small class="text-muted">{{'@'.$post->User->username}}</small>
                <small class="text-muted pull-right">{{ $post->created_at->diffForHumans() }}</small>
              </div>
              <div class="card-text card-item">
                <img class="img-circle" height="50px" width="50px" style ="margin-right:10px; background-color:#{{$post->User->color}};" src="{{ $post->User->avatar }}"/>
                <span data-toggle="true">
                  <?php $postLength = strlen(parse_post( nl2br(e($post->text)) ));
                  ?>
                  {!! substr(parse_post( nl2br(e($post->text)) ), 0, 250) !!}
                </span>
                @if($postLength >= 250)
                    <span class="collapse" id="read{{$post->id}}" >
                        {!! substr(parse_post( nl2br(e($post->text)) ), 250, $postLength) !!}
                    </span>
                    <p>
                      <a data-toggle="collapse" href="#read{{$post->id}}" aria-expanded="false" aria-controls="read{{$post->id}}">
                        Toggle More
                      </a>
                    </p>
                @endif

              </div>
              @if(Auth::check())
                  <div class="card-icons card-item">
                    <a href="/repost/{{ $post->id }}"><i class="fa fa-retweet"></i> {{ $post->reposts()->count() }}</a>
                    <a href="/like/{{ $post->id }}"><i class="fa fa-heart"></i> {{ $post->likes()->count() }}</a>
                    <div class="dropdown pull-right">
                      <i class="fa fa-ellipsis-h" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
                      <div class="dropdown-menu drop-right" aria-labelledby="dropdownMenuButton">
                        @if (Auth::user()->username == $post->user)
                            <a class="dropdown-item" href="/delete/post/{{$post->id}}"
                                  onclick="event.preventDefault();
                                           document.getElementById('delete-form').submit();">
                                   Delete
                            </a>
                            <form id="delete-form" action="/delete/post/{{$post->id}}" method="POST" style="display: none;">
                                  {{ csrf_field() }}
                            </form>
                        @else
                            @if (!\App\Friend::where('user_id','=',$post->user_id)->where('follower','=',Auth::user()->username)->exists())
                                <a class="dropdown-item" href="/friend/{{$post->user_id}}">Follow User</a>
                            @else
                                <a class="dropdown-item" href="/friend/{{$post->user_id}}">Unfollow User</a>
                            @endif
                        @endif


                      </div>
                    </div>
                  </div>
              @endif
            </div>
                @endforeach
        </div>








  </div>




  @endsection

@if($timeline->is_repost)
  <div class="reposted-post">
    <i class="fa fa-retweet"></i>
    <a href="/u/{{$timeline->AddedBy()->username}}">{{$timeline->AddedBy()->display_name}} reposted...</a>
  </div>
@endif

<div class=" card-item">
  <a href="/u/{{ $post->User->username }}">
    <img class="avatar" height="50px" width="50px" style ="margin-right:10px; background-color:{{$post->User->avatar_bg_color}};" src="{{ $post->User->avatar_url }}"/>
  </a>
  <a href="/u/{{ $post->User->username }}" class="post-name">{{ $post->User->display_name }}</a>
  <small class="text-muted post-username">{{'@'.$post->User->username}}</small>
  <small class="text-muted pull-right post-time">{{ $post->created_at->diffForHumans() }}</small>
</div>
<div class="card-text card-item">

  <span data-toggle="true" class="post-text">
    <?php $postLength = strlen(parse_post( nl2br(e($post->text)) ));
    ?>
    {!! substr(parse_post( nl2br(e($post->text)) ), 0, 250) !!}
  </span>
  @if($postLength >= 250)
      <span class="collapse" id="read{{$post->id}}" >
          {!! substr(parse_post( nl2br(e($post->text)) ), 250, $postLength) !!}
      </span>

      <a data-toggle="collapse" href="#read{{$post->id}}" aria-expanded="false" aria-controls="read{{$post->id}}" class="post-toggle">
        Read More
      </a>

  @endif

</div>
@if(Auth::check() && $post->isReply == 0)
<div class="card-icons card-item">
  <span class="icon repost" data-id="{{$post->id}}" >
    <i class="fa fa-retweet"></i> {{ $post->reposts()->count() }}
  </span>
  <span class="icon like" data-id="{{$post->id}}" >
    <i class="fa fa-heart"></i> {{ $post->likes()->count() }}
  </span>
  <span class="icon reply" data-id="{{$post->id}}" data-toggle="modal" data-target="#replyModal" >
    <i class="fa fa-reply"></i> {{ $post->replies()->count() }}
  </span>
  <div class="dropdown pull-right">
    <i class="fa fa-ellipsis-h post-settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></i>
    <div class="dropdown-menu drop-right" aria-labelledby="dropdownMenuButton">
      <span class="dropdown-item" data-toggle="modal" data-target="#getPostUrl" data-url-to-post="{{url('/post/'.$timeline->id)}}" >Copy Post Url</span>
      @if (Auth::user()->id == $post->user_id)
          <span class="dropdown-item" style="cursor:pointer;"
                onclick="event.preventDefault();
                         document.getElementById('delete-form').submit();">
                 Delete Post
          </span>
          <form id="delete-form" action="/delete/post/{{$post->id}}" method="POST" style="display: none;">
                {{ csrf_field() }}
          </form>
      @else
          @if (!\App\Friend::where('being_followed_id','=',$post->user_id)->where('follower_id','=',Auth::user()->id)->exists())
              <a class="dropdown-item" href="/friend/{{$post->user_id}}">Follow User</a>
          @else
              <a class="dropdown-item" href="/friend/{{$post->user_id}}">Unfollow User</a>
          @endif
      @endif
    </div>
  </div>
</div>
@endif

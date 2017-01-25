

<style media="screen">

.card{
  display: block;
  box-sizing: border-box;
  overflow: hidden;
  position: relative;
  margin-top: 15px;
  transition: border-color .1s linear;
  border: 1px solid #e0e0e0;
  background: white;
  border-radius: 4px;
  margin-bottom: 10px;
  box-shadow: none;
  font-size: 1.3rem;
    font-family: sans-serif;
}

.card-item {
    padding: 10px 15px;
}

.avatar {
    height: 40px;
    width: 40px;
    background: red;
    border-radius: 100%;
    display: inline-block;
    position: absolute;
    top: 50%;
    left: 0;
    transform: translateY(-50%);
}

.info {
    position: relative;
    display: inline-block;
    padding-left: 50px;
    width: 100%;
    box-sizing: border-box;
}

span.icon {
    position: relative;
    margin: 0 20px;
    height: 28px;
    line-height: 28px;
    cursor: pointer;
}
.icon .fa {
    left: -10px;
}

.right{
  text-align: right;
  float: right;
}
</style>


<div class="card">
  <div class=" card-item">

    <div class="info">
      <div class="avatar"></div>
      <div class="right">
        <div class="">{{ $post->created_at->diffForHumans() }}</div>
      </div>
      <div class="">{{$post->User->display_name}}</div>
      <div class="">{{$post->User->username}}</div>
      <div class="">Commutity</div>

    </div>
  </div>
  <div class=" card-item">
    {{ $post->text }}
  </div>
  <div class=" card-item">
    <span class="icon repost" data-id="{{$post->id}}" >
      <i class="fa fa-retweet"></i> {{ $post->reposts()->count() }}
    </span>
    <span class="icon like" data-id="{{$post->id}}" >
      <i class="fa fa-heart"></i> {{ $post->likes()->count() }}
    </span>
    <span class="icon reply" data-id="{{$post->id}}" data-toggle="modal" data-target="#replyModal" >
      <i class="fa fa-reply"></i> {{ $post->replies()->count() }}
    </span>
    <span class="icon reply pull-right" data-id="{{$post->id}}" data-toggle="modal" data-target="#replyModal" >
      <i class="fa fa-ellipsis-h "></i>
    </span>
  </div>
</div>






<!-- @if($timeline->is_repost)
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
@endif -->

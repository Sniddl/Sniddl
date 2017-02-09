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
    cursor: default;
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

.make-clickable{
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 0;
  cursor: pointer;
}
</style>



@foreach($events as $event)
<?php $post = $event->post;?>
<div class="card" >
  <div class="make-clickable" onclick="location.href='/post/{{ $post->id }}'"></div>
  <div class=" card-item">

    <div class="info">
      <div class="avatar"></div>
      <div class="right">
        <div class="">{{ $post->created_at->diffForHumans() }}</div>
      </div>
      <div class="">{{$post->user->display_name}}</div>
      <div class="">{{$post->user->username}}</div>
      <div class="">Commutity</div>

    </div>
  </div>
  <div class=" card-item">
    {{ $post->text }}
  </div>
  <div class=" card-item">
    <span class="icon repost"
          data-ajax="TRUE"
          data-href="/post/repost"
          data-request="POST"
          data-success='$(self).html(`<i class="fa fa-retweet"></i>` + data.count)'
          data-json='{
            "post_id": {{$post->id}}
          }'>
          <i class="fa fa-retweet"></i>
          {{ $post->reposts()->count() }}
    </span>
    <span class="icon like"
          data-ajax="TRUE"
          data-href="/post/like"
          data-request="POST"
          data-success='$(self).html(`<i class="fa fa-retweet"></i>` + data.count)'
          data-json='{
            "post_id": {{$post->id}}
          }'>
          <i class="fa fa-heart"></i>
          {{ $post->likes()->count() }}
    </span>
    <span class="icon reply" data-id="{{$post->id}}" data-toggle="modal" data-target="#replyModal" >
      <i class="fa fa-reply"></i> {{ $post->replies()->count() }}
    </span>
    <span class="icon reply pull-right" data-id="{{$post->id}}" data-toggle="modal" data-target="#replyModal" >
      <i class="fa fa-ellipsis-h "></i>
    </span>
  </div>
</div>
@endforeach

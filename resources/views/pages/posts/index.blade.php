<style media="screen">
#content{
  padding: 20px;
}
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
    margin-left: 50px;
}

.card-left {
  width: 50px;
  height: 100%;
  box-sizing: border-box;
  border-right: 1px solid #e0e0e0;
  position: absolute;
  left: 0;
  top: 0;
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

.vote{
  position: absolute;
  left: 0;
  height: 50%;
  width: 100%;
  z-index: 2;
  cursor: pointer;
  background-size: 100% 200%;
    -webkit-transition: background-position 1s;
    -moz-transition: background-position 1s;
    transition: background-position 0.25s;
    background-position: 0 -100%;
}.vote .number {
  position: absolute;
  width: 100%;
  text-align: center;
  left: 0;
  box-sizing: border-box;
  text-transform: uppercase;
  font-size: 14px;
}.voted{
  background-size: 100% 200%;
  -webkit-transition: background-position 0.25s;
  -moz-transition: background-position 0.25s;
  transition: background-position 0.25s;

}
.up {
    top: 0;
    background-position: 0 -100%;
    background-image: linear-gradient(to bottom, #63b992 50%, transparent 50%);
    border-bottom: 1px solid #e0e0e0;
}
.up:hover,
.up.voted{
  color: white;
  background-position: 0 0%;
}.up .fa{
  top: 66%;
}
.up .number {
  top: 20px;
}

.down {
    bottom: 0;
    background-position: 0 100%;
    background-image: linear-gradient(to bottom, #161027 50%, transparent 50%);
}
.down:hover,
.down.voted{
  background-position: 0 0%;
  color: white;
}.down .fa{
  top: 33%;
}
.down .number {
  bottom: 20px;
}

</style>



@foreach($events as $event)
<?php $post = $event->post;?>
<div class="card">
  <div class="card-left">
    <div class="up vote {{$post->voted('up', 'voted')}}"
         data-ajax="TRUE"
         data-success="$(self).find('.number').html(data.ups)"
         data-href="/post/vote/up"
         data-request="POST"
         data-json='{ "post_id":{{$post->id}} }'>
      <i class="fa fa-arrow-up"></i>
      <span class="number"> {{$post->ups()->count()}} </span>
    </div>
    <div class="down vote {{$post->voted('down', 'voted')}}"
         data-ajax="TRUE"
         data-success="$(self).find('.number').html(data.downs)"
         data-href="/post/vote/down"
         data-request="POST"
         data-json='{ "post_id":{{$post->id}} }'>
      <i class="fa fa-arrow-down"></i>
      <span class="number"> {{$post->downs()->count()}} </span>
    </div>
  </div>
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
    <span class="icon reply" data-id="{{$post->id}}" data-toggle="modal" data-target="#replyModal" >
      <i class="fa fa-comment"></i> {{ $post->replies()->count() }}
    </span>
    <span class="icon reply pull-right" data-id="{{$post->id}}" data-toggle="modal" data-target="#replyModal" >
      <i class="fa fa-ellipsis-h "></i>
    </span>
  </div>
</div>
@endforeach





@foreach($events as $event)
<?php $post = $event->post;?>

<div class="card">
  <div class="card-left">

    <div class="up vote {{$post->voted('up', 'voted')}}"
         v-href
         data-ajax="TRUE"
         data-success="$(self).find('.number').html(data.ups)"
         data-href="/post/vote/up"
         data-request="POST"
         data-json='{ "post_id":{{$post->id}} }'>
      <i class="fa fa-arrow-up"></i>
      <span class="number"> {{$post->ups()->count()}} </span>
    </div>

    <div class="down vote {{$post->voted('down', 'voted')}}"
         v-href
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
    @{{ message }}
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

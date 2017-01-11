<script>

  window.laravel = {
    token: '{{csrf_token()}}',
    @if(Auth::check())
      id: '{{Auth::user()->id}}',
      notifications: '{{Auth::user()->unreadNotifications->count()}}'
    @endif
  }
</script>
<script src="/js/layouts/post.js" charset="utf-8"></script>
<script src="/js/global.js" charset="utf-8"></script>
<script src="/js/community.js" charset="utf-8"></script>
<script src='https://cdn.rawgit.com/admsev/jquery-play-sound/master/jquery.playSound.js'></script>


<script id="socket-script">

var Tunnel = new Tunnel({
      host: "{{env('NODE_HOST', '\n**** MISSING .ENV NODE_HOST VARIABLE ****\n')}}",
    }),
    post_count = 0,
    reply_count = 0;


Tunnel.public({
  channel: 'post-channel',
  event: 'CreatedPost',
  success: function(data){
    post_count ++;
    if (post_count == 1){
      $('#new-post-event').html('Load '+ post_count + " new post.");}
    else{
      $('#new-post-event').html('Load '+ post_count + " new posts.")}
    $('#new-post-event').parent().parent().show();
  }
})

Tunnel.public({
  channel: 'post-channel',
  event: 'CreatedPost',
  success: function(data){
    reply_count ++;
    if (reply_count == 1){
      $('#new-reply-event').html('Load '+ reply_count + " new reply.");}
    else{
      $('#new-reply-event').html('Load '+ reply_count + " new replies.")}
    $('#new-reply-event').parent().parent().show();
  }
})

Tunnel.private({
  channel: 'App.User',
  event: 'NotificationUpdate',
  unique: window.laravel.id,
  success: function(data){
    $('.notification-circle').show();
    $.playSound("/notify")
  }
})

if (window.laravel.notifications > 0 && !base_url_is('notifications')) {
  $('.notification-circle').show();
  $.playSound("/notify")}



</script>

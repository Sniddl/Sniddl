<!-- JS -->

<script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
<script src="/js/global.js" charset="utf-8"></script>
<script src="/js/community.js" charset="utf-8"></script>

<script id="socket-script">
var socket = io.connect("http://192.81.217.250:3000");
var userId = $('meta[name=uid]').attr("content");
var post_count = 0;
var reply_count = 0;

socket.on('post-channel:App\\Events\\CreatedPost', function(data){
  post_count ++;
  if (post_count == 1){
    $('#new-post-event').html('Load '+ post_count + " new post.");}
  else{
    $('#new-post-event').html('Load '+ post_count + " new posts.")}
  $('#new-post-event').parent().parent().show();
});

socket.on('reply-channel:App\\Events\\CreatedPost', function(data){
  reply_count ++;
  if (reply_count == 1){
    $('#new-reply-event').html('Load '+ reply_count + " new reply.");}
  else{
    $('#new-reply-event').html('Load '+ reply_count + " new replies.")}
  $('#new-reply-event').parent().parent().show();
});

socket.on(userId+'-notification-channel:App\\Events\\NotificationUpdate', function(data){
  $('.notification-circle').show();
});
</script>

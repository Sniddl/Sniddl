/*
|--------------------------------------------------------------------------
| Repost Function
|--------------------------------------------------------------------------
|
| This function allows you to create or delete a repost with little effort.
| The database will automatically recieve the repost without refreshing.
|
*/

$('.repost').unbind().click(function(){
  var id = $(this).data('id');
  var _this = this;
  var _child = $(this).find("i").prop('outerHTML');

  $.ajax({
       type : 'POST',
       url  : base_url('repost/'+id),
       headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       data : {
         id: id,
       },
    }).done(function (msg) {
      $(_this).html(_child + " " + msg['repostAmount'])
    });
})


/*
|--------------------------------------------------------------------------
| Like Function
|--------------------------------------------------------------------------
|
| This function allows you to create or delete a repost with little effort.
| The database will automatically recieve the repost without refreshing.
|
*/

$('.like').unbind().click(function(){
  var id = $(this).data('id');
  var _this = this;
  var _child = $(this).find("i").prop('outerHTML');

  $.ajax({
       type : 'POST',
       url  : base_url('like/'+id),
       headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
       data : {
         id: id,
       },
    }).done(function (msg) {
      $(_this).html(_child + " " + msg['likeAmount'])
    });
})








$('.reply').unbind().click(function(){
  var id = $(this).data('id');
  $('#reply-post-id').val(id);
})





/*
|--------------------------------------------------------------------------
| Go Live
|--------------------------------------------------------------------------
|
|
|
|
*/
// var refresh_rate_sec = 1
// var post_feed = setInterval(function() {
//   var last_update = $(".timeline-info").data('last-post-update')
//   $.ajax({
//        type : 'POST',
//        url  : base_url('post-feed'),
//        headers: {
//           'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
//         },
//        data : {
//          last_update: last_update,
//        },
//     }).done(function (msg) {
//       var thereAreNewPost = msg["thereAreNewPost"];
//       var count = msg['amountOfNewPosts'];
//       if (thereAreNewPost) {
//         $('#new-events').html('View '+ count + " new events.")
//         $('#new-events').parent().parent().show();
//       }
//     });
//
// }, refresh_rate_sec * 10000);







//

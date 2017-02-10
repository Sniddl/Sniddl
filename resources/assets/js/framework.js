

// DATA ATTRIBUTES
// * functions that are related to data attributes.

$('[data-toggle]').click(function(e){
  // Toggles the target element
  e.preventDefault();
  var toggle = $(this).data("toggle");
  $(toggle).toggle();
});



$('[data-href]').click(function (e) {
  var request = $(this).data("request").toUpperCase();
  var url = $(this).data("href");
  var json = $(this).data("json");
  var ajax = $(this).data("ajax");
  var success = $(this).data("success");
  var error = $(this).data("error");
  window.data_href_clicked_object = this;

  e.preventDefault();

  if (ajax) {

    $.ajax({
      type: request,
      url: url,
      headers: {
        'X-CSRF-TOKEN': window.Laravel.csrfToken,
        'AJAX': true
      },
      data: json,
      success: function s(data) {
        if(success){
          var self = window.data_href_clicked_object;
          eval(success);
        }else{
          console.log("%c\
          Ajax was successful.\n\
          Write or call code to run by using the 'data-success' or 'data-success' attribute.\n\
          Use the 'data' object as a parameter to retrieve the Ajax results.",
          "color:#ccc; font-size: 14px; "
          );
          console.log('data:\n',data);
        }

      },
      error: function e(data){
        if(error){
          eval(error)
        }else{
            document.write( data.responseText );
        }
      }
    });
  } else if (request) {
    //create form
    $('<form>').attr("id", "globalForm").attr('method', request).attr('action', url).appendTo("body");

    // create csrf token if POST request
    if (request == "POST") {
      $('<input>').attr("name", "_token").attr("value", window.Laravel.csrfToken).attr('type', 'hidden').appendTo("#globalForm");
    }

    // create hidden input for each json key
    $.each(json, function (key, data) {
      $('<input>').attr("name", key).attr("value", data).attr('type', 'hidden').appendTo("#globalForm");
    });

    //subit form & redirect
    $("#globalForm").submit();
  } else {
    window.location = url;
  }
});





$('.vote').click(function(){
  var up = $(this).parent().find('.up')
  var down = $(this).parent().find('.down')
  var upNum = up.find('.number')
  var downNum = down.find('.number')
  $(this).toggleClass('voted');
  if ($(this).hasClass("up") && down.hasClass('voted') ){
    down.removeClass('voted');
    var num = parseInt(downNum.html());
    downNum.html(num -1)
  }
  if ($(this).hasClass("down") && up.hasClass('voted') ){
    up.removeClass('voted');
    var num = parseInt(upNum.html());
    upNum.html(num -1)
  }
})

 __FRAMEWORK__ = function(){

    // DATA ATTRIBUTES
    // * functions that are related to data attributes.

    
    window.base_url = function(relative=false) {
      var getUrl = window.location;
      var baseUrl = getUrl .protocol + "//" + getUrl.host + "/";
      return relative ? baseUrl+relative : baseUrl;
    }
    window.base_url_is = function(path) {
      return base_url(path) == window.location.href;
    }


    $('[data-toggle]').click(function(e){
      // Toggles the target element
      console.log("data-toggle clicked");
      e.preventDefault();
      var toggle = $(this).data("toggle");
      $(toggle).toggle();
    });




      $.fn.__data__ = function(property = null) {
          if(property){
            return this[0].__data__[property];
          }
          return this[0].__data__;
      };
      $('.v-href').click(function (e) {
        window.data_href_clicked_object = this;
        var request = $(this).__data__("request");
        var url     = $(this).__data__("href");
        var json    = $(this).__data__("json");
        var ajax    = $(this).__data__("ajax");
        var success = $(this).__data__("success");
        var error   = $(this).__data__("error");

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
        }
        else if (request) {
          request = request.toUpperCase();
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
        }
        else {
          window.location = url;
        }
      });







    $('.vote').click(function(){
      console.log("hello");
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



























}// End of file! Nothing beyond this point!
 // This file and other js files must be 'namespaced' in order to work with VueJS.
 // To do this wrap the file in a function.
 // Use the file name in all caps surrounded by double underscores.

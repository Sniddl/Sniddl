window.base_url = function(relative=false) {
  var getUrl = window.location;
  var baseUrl = getUrl .protocol + "//" + getUrl.host + "/";
  return relative ? baseUrl+relative : baseUrl;
}

window.SelectText = function(element) {
    var doc = document
        , text = doc.getElementById(element)
        , range, selection
    ;
    if (doc.body.createTextRange) {
        range = document.body.createTextRange();
        range.moveToElementText(text);
        range.select();
    } else if (window.getSelection) {
        selection = window.getSelection();
        range = document.createRange();
        range.selectNodeContents(text);
        selection.removeAllRanges();
        selection.addRange(range);
    }
}


var ajaxOnClickFunction = $('.ajax').click(function(e) {
  e.preventDefault()
  var form = $(this).parent()
  var method = form.attr("method")
  var action = form.attr("action")
  var success = form.data("success")
  var token = '{{ Session::token() }}'
  $.ajax({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    },
    url: action,
    type: "post",
    data: form.serialize(),
    success: function(result){
      $('.ajaxErrors').hide()
      form[0].reset();
      window.result = result
      eval(success)
    },
    error: function(data){
        $('.ajaxErrors').show()
        window.scrollTo(0, 0);

        try {
          var response = JSON.parse(data.responseText)
        } catch (e) {
          document.write(data.responseText);
        }
        if (typeof response === "object"){
          for (var msg in response) {
            var error = response[msg];
            if (typeof error === "object"){
              for(var index in error){
                $('.ajaxErrors > .alert > ul').append("<li>"+error[index]+"</li>");
              }
            }else{
              $('.ajaxErrors > .alert > ul').append("<li>"+error+"</li>");
            }
          }
        }
    }//end of error function
  })
})

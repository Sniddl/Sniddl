



window.base_url = function(relative=false) {
  var getUrl = window.location;
  var baseUrl = getUrl .protocol + "//" + getUrl.host + "/";
  return relative ? baseUrl+relative : baseUrl;
}
window.base_url_is = function(path) {
  return base_url(path) == window.location.href;
}


$('document').ready(function(){
  if(location.pathname.split("/")[1] == "post"){
    $('.post-block').css('cursor','default')
  }
  window.post_text = true;
});

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
      document.write(result)
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



$('.post-text')
    .mouseover(function(){
      window.post_text = false;
    }).mouseout(function(){
      window.post_text = true;
    });
$('.card-icons')
    .mouseover(function(){
      window.post_text = false;
    }).mouseout(function(){
      window.post_text = true;
    });

$('.post-block').click(function() {
  var link = $(this).data('link')


  if ( location.href != link && post_text) {
    location.href = link;
  }
});


window.Tunnel = class Tunnel {
  constructor(params) {
    this.socket = io.connect(params.host);
  }

  public(params){
    this.socket.on(params.channel + ':App\\Events\\'+params.event, function(data){
      params.success(data);
    });
  }

  private(params){
    this.socket.on("private-"+params.channel + "." + params.unique + ':App\\Events\\'+params.event, function(data){
      params.success(data);
    });
  }


}

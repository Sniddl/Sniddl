$.fn.expand = function(options){
  switch (options) {
    case "show":
      $(this).show({
        direction: "down",
        duraction: '500',
        easing: 'swing',
      })
      break;
    case "hide":
      $(this).hide()
      break;
    case "toggle":
      $(this).toggle()
      break;
    default:
      $(this).show();
  }
}



$(document).ready(function() {



  $('pre code').each(function(i, block) {
    escapedCode = $(this).html()
                                .replace(/</g, "&lt;")
                                .replace(/>/g, "&gt;")
                                .replace(/"/g, "&quot;")
                                .replace(/'/g, "&#039;");
    $(this).html(escapedCode);
    hljs.highlightBlock(block);
  });
  var hash = location.hash;
  if(hash.length == 0){
    $('.default-tab').expand();
  }else {
    $("a[data-toggle='expand']").removeClass("active")
    $("a[aria-controls='"+ hash +"']").addClass("active")
    $(hash).expand('show');
  }
  $("a[data-toggle='expand']").click(function(){
    $('.expand').expand('hide');
    $("a[data-toggle='expand']").removeClass("active")
    $(this).addClass("active")
    id = $(this).attr('href');
    $(id).expand('show')
  });

  $('[data-toggle="tooltip"]').tooltip()
});

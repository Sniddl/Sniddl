

// DATA ATTRIBUTES
// * functions that are related to data attributes.

$('[data-toggle]').click(function(e){
  // Toggles the target element
  e.preventDefault();
  var target = $(this).data("target");
  $(target).toggle();
});



$('[data-href]').click(function(e){
  var request = $(this).data("request").toUpperCase();
  var url = $(this).data("href");
  var json = $(this).data("json");
  var ajax = $(this).data("ajax");



  e.preventDefault();

  if (ajax){

    $.ajax({
        type: request,
        url: url,
        headers: {
          'X-CSRF-TOKEN': window.Laravel.csrfToken
        },
        data: json,
        success: function() {
          alert('success');
        }
    });

  }else if (request){
    //create form
    $('<form>')
      .attr("id", "globalForm")
      .attr('method', request)
      .attr('action', url)
      .appendTo("body");


    // create csrf token if POST request
    if (request == "POST") {
    $('<input>')
      .attr("name", "_token")
      .attr("value", window.Laravel.csrfToken)
      .attr('type','hidden')
      .appendTo("#globalForm");}


    // create hidden input for each json key
    $.each(json, function (key, data) {
      $('<input>')
        .attr("name", key)
        .attr("value", data)
        .attr('type','hidden')
        .appendTo("#globalForm");});

    //subit form & redirect
    $("#globalForm").submit();

  }else{
    window.location = url;
  }


})

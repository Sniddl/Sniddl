$(document).ready(function () {

    $(".list-container").sortable({
        items: "div:not(.list-heading)",
        connectWith: ".lists",
    
    }).disableSelection();
    $(".list-container").on("sortupdate", function(event, ui){
      var order = $(this).sortable('toArray');
      var column = $(this).attr("id");
      var content = $('#'+column).html();
      console.log(content);
      $.ajax({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        url: "/cards",
        type: "post",
        data: {
          column: column,
          content: content
        },
        success: function(result){
          console.log("success");
        }
      });
    });


    $(".list-container").each(function(){
      var data = $(this).data('content');
      $(this).html(data);
      $(this).removeData('content');
    })

    $('.delete').click(function(){
      var div = $(this).parent();
      div.remove();
      $(".list-container").trigger('sortupdate');
    })


});


$("#create-card-button").click(function(e){
  e.preventDefault();
  var title = $('#title').val();
  var brief = $('#brief').val();
  var assigned = $('#assigned').val();
  $('#create-card').modal('toggle');
  $('#Issues').append(
    `<div class="issue">
        <h4 class="issue-title">`+title+`</h4>
        <p class="issue-text">`+brief+`</p>
        <span><b>Assigned to: </b><span contenteditable="true">`+assigned+`</span></span>
        <span class="delete"><i class="fa fa-trash" aria-hidden="true"></i></span>
      </div>`
  )
  $(".list-container").trigger('sortupdate');

})

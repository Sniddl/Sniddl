<div class="modal fade" id="getPostUrl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h5 class="modal-title text-center" id="myModalLabel" style="color:#818a91;">Copy link to post.</h5>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <small class="form-text text-muted">Do whatever.</small>
          <input type="text" class="form-control" id="urlToPost">
        </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $('[data-toggle="modal"]').click(function(){
    var url = $(this).data('url-to-post')
    $('#urlToPost').val(url)
    $('#urlToPost').focus()
    $('#urlToPost').select()
  })


</script>

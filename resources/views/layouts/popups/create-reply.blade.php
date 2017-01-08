
<!-- Create Reply Modal -->
<div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" style="color:darkgrey">Create a reply</h4>
      </div>
      <div class="modal-body">
      <form class="" action="/create-reply" method="post">
          <input type="hidden" name="_token" value="{{ csrf_token() }}">
          <input id="reply-post-id" type="hidden" name="id" value="">
          <div class="form-group">
            <textarea name="text" class="form-control vresize" rows="5" placeholder="What are your thoughts on this?"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="post-submit">Reply</button>
      </div>
      </form>
    </div>
  </div>
</div>


<!-- Create Post Modal -->
<div class="modal fade" id="postModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel" style="color:darkgrey">Create a post</h4>
      </div>
      <div class="modal-body">
      <form class="" action="/create-post" method="post">
        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <div class="form-group">
          <textarea name="text" class="form-control vresize" rows="5" placeholder="Tell me something exciting"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary" name="post-submit">Post</button>
      </div>
      </form>
    </div>
  </div>
</div>

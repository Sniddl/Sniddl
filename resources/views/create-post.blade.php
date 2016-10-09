
<form class="" action="/create-post" method="post">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group">
    <textarea name="text" class="form-control vresize" rows="5" placeholder="Tell me something exciting"></textarea>
  </div>

  <div class="modal-footer">
    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
    <button type="submit" class="btn btn-primary" name="post-submit">Post</button>
  </div>


</form>

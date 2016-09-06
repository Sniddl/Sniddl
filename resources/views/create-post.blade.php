
<form class="" action="create-post" method="post">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group">
    <textarea name="text" class="form-control vresize" rows="5"></textarea>
  </div>

  <div class="form-group">
      <button type="submit" class="btn btn-primary" name="post-submit">Post</button>
  </div>

</form>

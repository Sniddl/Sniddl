
<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        <h4 class="modal-title" id="myModalLabel" style="color:darkgrey">Are you sure?</h4>
      </div>
      <div class="modal-body">
      <form class="deleteAccForm" action="/delete-account" method="post">
              <input type="hidden" name="_token" value="{{ csrf_token() }}">
              <div class="form-group">
                <input type="password" name="password" placeholder="Password" style="margin-top:15px;" required></input>
              </div>
              <div class="form-group">
                <input type="password" name="password_confirmation" placeholder="Verify Password" required></input>
              </div>
      </div>
      <div class="modal-footer">
            <p style="float:left; color:#e00000; font-size:14px; padding-top:10px;">This action cannot be undone!</p>
            <button type="submit" class="btn btn-danger" name="delete-account">Delete</button>
      </div>
      </form>
    </div>
  </div>
</div>

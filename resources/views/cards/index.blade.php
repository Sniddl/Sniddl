@include('head')




<style media="screen">
body{
  background: #282c34;
  margin: 0;
  padding: 0;
}
.list-container {
    border: none;
    padding: 10px;
    background: #2e3440;
    height: 100%;
    border-right: 1px solid #575d6b;
    border-left: 1px solid #575d6b;
    padding-top: 50px;

}
.issue {
  background: #485063;
  font-size: 12px;
  color: #ccc;
  border: 1px solid #6e6e6e;
  padding: 10px;
  border-radius: 10px;
  box-shadow: 0px 2px 4px rgb(0, 0, 0);
  cursor: move;
  margin: 10px 0;
  position: relative;
}
.list-heading {
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 2px;
    color: #ccc;
    border-bottom: 1px solid #6e6e6e;
    padding: 10px;
    box-shadow: 0px 2px 4px rgb(0, 0, 0);
    width: 100%;
    position: absolute;
    top: 0;
    left: 0;
    background: #485063;
}
span.delete {
    position: absolute;
    bottom: -2px;
    right: 0;
    padding: 10px;
    font-size: 17px;
    cursor: pointer;
    z-index: 10;
}
</style>

<nav class="navbar navbar-light bg-faded">
  <div class="container">
    <button type="button" class="btn btn-primary btn-sm " data-toggle="modal" data-target="#create-card">
    <i class="fa fa-plus-circle" aria-hidden="true"></i>  Add Issue
    </button>
  </div>

</nav>


<div class="container">


  <div class="row">
    @foreach($columns as $column)
      <div class="lists list-container col-lg-3" id="{{$column->column}}" data-content="{{$column->content}}">
        <!-- need to add a container div so headers stay. -->
        <!-- need to add a way so column count auto stays -->
            <!-- Probably a function to add columns -->
      </div>
    @endforeach
  </div>


</div>


<form  id="create-card-form" action="/cards/add" method="post">
  <!-- Modal -->
  <div class="modal fade" id="create-card" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
          <h4 class="modal-title" id="myModalLabel">Create an Issue</h4>
        </div>
        <div class="modal-body">

            <div class="form-group">
              <label>Title</label>
              <input type="text" class="form-control"  id="title">
            </div>
            <div class="form-group">
              <label>Description</label>
              <input type="text" class="form-control"  id="brief">
            </div>
            <div class="form-group">
              <label>Assigned To</label>
              <input type="text" class="form-control"  id="assigned">
            </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary" id="create-card-button">Create</button>
        </div>
      </div>
    </div>
  </div>
</form>






<script src="/js/cards/main.js" charset="utf-8"></script>
<link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

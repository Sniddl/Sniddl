@extends('home')
@section('edit')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
  @if (session()->has('flash_notification.message'))
      <div class="alert alert-{{ session('flash_notification.level') }}">
          {!! session('flash_notification.message') !!}
      </div>
  @endif

  <img class="img-circle" height="100px" width="100px" src="{{ Auth::user()->avatar }}" style="background-color: #{{Auth::user()->color}}"/>
  <h1>Editing {{{ Auth::user()->username }}}'s profile...</h1>



  <p>Username: <span style="padding-left: 15px; color:teal;">{{Auth::user()->username}}</span></p>
  <form class="" action="/edit/profile/avatargen" method="POST">
    <label>Generate Profile Picture</label><br>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" class="btn btn-sm btn-primary" value="Generate">
  </form>

  @yield('generateAvatar')
  <br><br>
  <form class="" enctype="multipart/form-data" action="/edit/profile/avatar" method="POST">
    <label>Update Profile Image</label>
    <input type="file" name="avatar"><br>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" class="btn btn-sm btn-primary" value="Upload">
  </form>

  <!--Change display name-->
  <h3>Change display name</h3>
    <form action="/changeName">
      <input type="text" name="displayname" placeholder="{{{ Auth::user()->name }}}"/>
      <input type="submit" class="btn btn-sm btn-primary" value="Update"/>
    </form>

  <!--Change password-->
  <h3>Change password</h3>
  <form action="/changePWD" style="padding-top: 20px;">
    <input type="password" name="currentpassword" placeholder="Current password"><br>
    <input type="password" name="newpassword" placeholder="New password" style="margin-top:10px;"><br>
    <input type="password" name="verifynewpwd" placeholder="Verify new password" style="margin-top:10px;"><br>
    <input type="submit" class="btn btn-sm btn-primary" value="Update">

  </form>
  <!--Change email-->
  <h3>Change email</h3>
  <form action="/changeEmail" style="padding-top: 20px;">
    <input type="text" name="changeemail" placeholder="{{{Auth::user()->email}}}">
    <input type="submit" class="btn btn-sm btn-primary" value="Update">
  </form>

  <!-- Button trigger modal -->
  <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal" style="float:right;">
    Deactivate your account
  </button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel">Deactivate your account</h4>
        </div>
        <form action="/deactivate" autocomplete="off">
        <div class="modal-body">
          @if (session()->has('flash_notification.level'))
              <div class="alert alert-{{ session('flash_notification.level') }}">
                  {!! session('flash_notification.message') !!}
              </div>
          @endif
          <center><h4 style="color:#ff4b4b;"><b>Warning!</b> This action cannot be undone once complete</h4></center>
          <br>
          <hr>
          <h4>If you wish to continue:</h4>
          <p>Enter your username</p>
          <input type="text" name="deac-username" placeholder="Username" style="width:230px;">
          <p>Enter your password</p>
          <input type="password" name="deac-password" placeholder="Current password" style="width:230px;">
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-danger" value="Update">Deactivate</button>
        </div>
      </form>
      </div>
    </div>
  </div>
</div>


<script>
  $('div.alert').delay(4000).slideUp(300);
</script>

@endsection

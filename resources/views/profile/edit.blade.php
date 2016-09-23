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
  <img class="img-circle" height="100px" src="{{ Auth::user()->avatar }}"/>
  <h1>Editing {{ Auth::user()->username }}'s profile...</h1>




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
      <input type="text" name="displayname" placeholder="{{ Auth::user()->name }}">
      <input type="submit" class="btn btn-sm btn-primary" value="Update">
    </form>
  <!--Change password-->
  <h3>Change password</h3>
  <form action="POST" style="padding-top: 30px;">
    <input type="text" name="currentpassword" placeholder="Current password">
    <input type="text" name="newpassword" placeholder="New password">
    <input type="text" name="verifynewpwd" placeholder="Verify new password">
  </form>
  <!--Disallow search for the user-->
  <h3>Allow for users to search for your profile</h3>
  <input type="checkbox" name="privatetickbox">
  <!--Mute Notifications-->
  <h3>Mute notifications</h3>
  <input type="checkbox" name="mutenotifs">
</div>



@endsection

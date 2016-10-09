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
  <h1 style="padding-top:20px;">Editing {{{ Auth::user()->username }}}'s profile...</h1>

  <p>Username: <span style="padding-left: 15px; color:#d98826;">{{Auth::user()->username}}</span></p>
  <form class="" action="/edit/profile/avatargen" method="POST">
    {{ csrf_field() }}
    <label>Generate Profile Picture</label><br>
    <input type="submit" class="btn btn-outline-primary btn-sm" value="Generate">
  </form>

  @yield('generateAvatar')
  <br><br>
  <form class="" enctype="multipart/form-data" action="/edit/profile/avatar" method="POST">
    {{ csrf_field() }}
    <label for="avatar_upload">Update Profile Image</label><br>
    <input type="file" name="avatar" id="avatar_upload"><br>
    <input type="submit" class="btn btn-outline-primary btn-sm" value="Upload" style="margin-top:10px;">
  </form>

  <!--Change display name-->
    <form action="/changeName" method="post">
      {{ csrf_field() }}
      <label for="dnchange" style="padding-top:15px;">Change display name</label><br>
      <input id="dnchange" type="text" name="displayname" placeholder="{{{ Auth::user()->name }}}"/>
      <input type="submit" class="btn btn-outline-primary btn-sm" value="Update"/>
    </form>

  <!--Change password-->
  <form action="/changePWD" method="post">
    {{ csrf_field() }}
    <label style="padding-top:15px;">Change password</label><br>
    <input type="password" name="currentpassword" placeholder="Current password"><br>
    <input type="password" name="newpassword" placeholder="New password" style="margin-top:10px;"><br>
    <input type="password" name="newpassword_confirmation" placeholder="Verify new password" style="margin-top:10px;">
    <input type="submit" class="btn btn-outline-primary btn-sm" value="Update">

  </form>
  <!--Change email-->
  <form action="/changeEmail" method="post">
    {{ csrf_field() }}
    <label style="padding-top:15px;">Change Email</label><br>
    <input type="text" name="changeemail" placeholder="{{{Auth::user()->email}}}">
    <input type="submit" class="btn btn-outline-primary btn-sm" value="Update">
  </form>


@endsection

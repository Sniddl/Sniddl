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
    {{ csrf_field() }}
    <label>Generate Profile Picture</label><br>
    <input type="submit" class="btn btn-sm btn-primary" value="Generate">
  </form>

  @yield('generateAvatar')
  <br><br>
  <form class="" enctype="multipart/form-data" action="/edit/profile/avatar" method="POST">
    {{ csrf_field() }}
    <label>Update Profile Image</label>
    <input type="file" name="avatar"><br>
    <input type="submit" class="btn btn-sm btn-primary" value="Upload">
  </form>

  <!--Change display name-->
  <h3>Change display name</h3>
    <form action="/changeName" method="post">
      {{ csrf_field() }}
      <input type="text" name="displayname" placeholder="{{{ Auth::user()->name }}}"/>
      <input type="submit" class="btn btn-sm btn-primary" value="Update"/>
    </form>

  <!--Change password-->
  <h3>Change password</h3>
  <form action="/changePWD" style="padding-top: 20px;" method="post">
    {{ csrf_field() }}
    <input type="password" name="currentpassword" placeholder="Current password"><br>
    <input type="password" name="newpassword" placeholder="New password" style="margin-top:10px;"><br>
    <input type="password" name="newpassword_confirmation" placeholder="Verify new password" style="margin-top:10px;"><br>
    <input type="submit" class="btn btn-sm btn-primary" value="Update">

  </form>
  <!--Change email-->
  <h3>Change email</h3>
  <form action="/changeEmail" style="padding-top: 20px;" method="post">
    {{ csrf_field() }}
    <input type="text" name="changeemail" placeholder="{{{Auth::user()->email}}}">
    <input type="submit" class="btn btn-sm btn-primary" value="Update">
  </form>

  <!-- Button trigger modal -->
  <a href="/delete/user">
    Deactivate your account
 </a>

  <!-- Modal -->
  @if(Session::has('confirmDeletion'))
  <h1>hey</h1>
  @endif


@endsection

@extends('home')
@section('edit')

  @if (session()->has('flash_notification.message'))
      <div class="alert alert-{{ session('flash_notification.level') }}">
          {!! session('flash_notification.message') !!}
      </div>
  @endif
  @if (count($errors) > 0)
      <div class="alert alert-danger" role="alert">
          <ul>
              @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
              @endforeach
          </ul>
      </div>
  @endif

@include ('layouts.popups.delete-account')

  <div class="ajaxErrors" style="display:none">
    <div class="alert alert-danger" role="alert">
        <ul>
        </ul>
    </div>
  </div>

  <div class="container" id="user-settings">

    <img class="img-circle" height="100px" width="100px" src="{{ Auth::user()->avatar_url }}" style="background-color: {{Auth::user()->avatar_bg_color}}"/>
    <p>
      <strong id="displayname" style="padding-top:20px;">{{ Auth::user()->name }}</strong>
      <small id="username">
      {{ "@".Auth::user()->username }}
      </small>
    </p>

    <div class="card card-block">
      <div class="container">
        <h5 class="setting-block">Profile Settings</h5>
        <div class="card-collapse collapse" id="profile-settings">

          <form class="card-form" action="/profileSettings" method="post" data-success="profileSettings()"><!--  see /js/global.js@ajaxOnClickFunction -->
            {{ csrf_field() }}
            <label for="displayname" style="padding-top:15px;">Change display name</label>
              <input type="text" name="displayname" placeholder="{{ Auth::user()->display_name }}"/>
            <label for="username" style="padding-top:15px;">Change username</label>
              <input type="text" name="username" placeholder="{{ Auth::user()->username }}"/>
            <label style="padding-top:15px;">Change password</label>
              <input type="password" name="currentpassword" placeholder="Current password">
              <input type="password" name="newpassword" placeholder="New password" style="margin-top:10px;">
              <input type="password" name="newpassword_confirmation" placeholder="Verify new password" style="margin-top:10px;">
            <label style="padding-top:15px;">Change Email</label>
              <input type="text" name="changeemail" placeholder="{{Auth::user()->email}}">
            <input type="submit" class="btn btn-primary" value="Save Changes">
          </form>

        </div>
      </div>
      <button class="card-toggle" data-toggle="collapse" data-target="#profile-settings" aria-expanded="false" aria-controls="collapseExample">
        <i class="fa fa-angle-double-down" aria-hidden="true"></i>
      </button>
    </div>


    <div class="card card-block">
      <div class="container">
        <h5 class="setting-block">Avatar Settings</h5>
        <div class="card-collapse collapse" id="avatar-settings">
          <form class="card-form" enctype="multipart/form-data" action="/edit/profile/avatar" method="post" >
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label for="displayname" style="padding-top:15px;">Upload Avatar</label>
              <input type="file" name="avatar"/>
            <input type="submit" class="btn btn-primary " value="Save Changes">
          </form>
        </div>
      </div>
      <button class="card-toggle" data-toggle="collapse" data-target="#avatar-settings" aria-expanded="false" aria-controls="collapseExample">
        <i class="fa fa-angle-double-down" aria-hidden="true"></i>
      </button>
    </div>


    <div class="card card-block">
      <div class="container">
        <h5 class="setting-block">Banner Settings</h5>
        <div class="card-collapse collapse" id="banner-settings">
          <form class="card-form" enctype="multipart/form-data" action="/edit/profile/banner" method="post" >
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label for="displayname" style="padding-top:15px;">Upload Banner</label>
              <input type="file" name="banner"/>
            <input type="submit" class="btn btn-primary " value="Save Changes">
          </form>
        </div>
      </div>
      <button class="card-toggle" data-toggle="collapse" data-target="#banner-settings" aria-expanded="false" aria-controls="collapseExample">
        <i class="fa fa-angle-double-down" aria-hidden="true"></i>
      </button>
    </div>

    <div class="card card-block">
      <div class="container">
        <h5 class="setting-block">Delete your account</h5>
        <div class="card-collapse collapse" id="delete-account-settings">
          <div class="card-form">
            <button type="submit" class="btn btn-danger " data-toggle="modal" data-target="#deleteAccModal" style="width: 100%;">Delete account</button>
          </div>
        </div>
      </div>
      <button class="card-toggle" data-toggle="collapse" data-target="#delete-account-settings" aria-expanded="false" aria-controls="collapseExample">
        <i class="fa fa-angle-double-down" aria-hidden="true"></i>
      </button>
    </div>



    <form action="/toggleDarkness" method="POST">
      {{ csrf_field() }}
      @if (Auth::user()->isDark == 0)
        <input class="btn btn-primary" type="submit" value="Night Time!"></input>
      @else
        <input class="btn btn-primary" type="submit" value="Day Time!"></input>
      @endif
    </form>
  </div>

  <script type="text/javascript">
    function profileSettings() {
      $('#displayname').html(result.name)
      $('#username').html("@"+result.username)
      $( "input[name='displayname']").attr("placeholder", result.name)
      $( "input[name='username']").attr("placeholder", result.username)
      $( "input[name='changeemail']").attr("placeholder", result.email)
    }

    $('.card-toggle').click(function() {
      var id = $(this).data('target');
      if ( $(id).attr("aria-expanded") == "true" ) {
        $(this).html('<i class="fa fa-angle-double-down" aria-hidden="true"></i>');
      }else {
        $(this).html('<i class="fa fa-angle-double-up" aria-hidden="true"></i>');
      }
    });
  </script>




@endsection

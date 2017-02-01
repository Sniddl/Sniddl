@extends('home')
@section('edit')

  @if (session()->has('flash_notification.message'))
      <div class="alert alert-{{ session('flash_notification.level') }}">
          {!! session('flash_notification.message') !!}
      </div>
  @endif


  <div class="ajaxErrors" style="display:none">
    <div class="alert alert-danger" role="alert">
        <ul>
        </ul>
    </div>
  </div>

  <!-- <div class="container" id="user-settings">

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

          <form class="card-form" action="/profileSettings" method="post" data-success="profileSettings()">
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
  </script> -->

  <div class="c-6 o-3 profile-settings">
    <div class="ui tabular menu">
      <div class="item active" data-tab="General">General</div>
      <div class="item" data-tab="Appearance">Appearance</div>
      <div class="item" data-tab="Security">Security</div>
    </div>
    @if (count($errors) > 0)
    <div class="ui error message">
      <div class="header">
        Yikes! We found some errors
      </div>
      <ul class="list">
          @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
          @endforeach
      </ul>
    </div>
    @endif
    <div class="ui tab active" data-tab="General">
      <form class="c-6 o-3"action="/profileSettings" method="post" data-success="profileSettings()">
        {{ csrf_field() }}
        <label for="ps-displayname">Display Name</label>
        <input name="displayname" class="fullwidth" type="text" placeholder="{{ Auth::user()->display_name }}" id="ps-displayname">
        <label for="ps-displayname">Username</label>
        <input name="username" class="fullwidth" type="text" placeholder="{{ Auth::user()->username }}" id="ps-username">
        <label for="ps-email">Email</label>
        <input name="changeemail" class="fullwidth" type="text" placeholder="{{ Auth::user()->email }}" id="ps-email">
        <input class="pull-right" type="submit" value="Update">
      </form>
    </div>

    <div class="ui tab" data-tab="Appearance">
      <!-- <div class="card card-block">
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
      </div> -->
    </div>

    <div class="ui tab" data-tab="Security">
      <form class="c-6 o-3"action="/profileSettings" method="post" data-success="profileSettings()">
        {{ csrf_field() }}
        <label for="ps-currentpassword">Current Password</label>
        <input name="currentpassword" class="fullwidth" type="password" id="ps-currentpassword">
        <label for="ps-newpassword">New Password</label>
        <input name="newpassword" class="fullwidth" type="password" id="ps-newpassword">
        <label for="ps-verifypassword">Verify New Password</label>
        <input name="newpassword_confirmation" class="fullwidth" type="password" id="ps-verifypassword">
        <h4 class="ui horizontal divider header"><i class="lock icon"></i></h4>
        <input class="pull-right" type="submit" value="Update">
      </form>

    </div>
  </div>



@endsection

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




  <div class="ajaxErrors" style="display:none">
    <div class="alert alert-danger" role="alert">
        <ul>

        </ul>
    </div>
  </div>

  <img class="img-circle" height="100px" width="100px" src="{{ Auth::user()->avatar }}" style="background-color: #{{Auth::user()->color}}"/>
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
          <label for="displayname" style="padding-top:15px;">Change display name</label>
            <input type="text" name="displayname" placeholder="{{ Auth::user()->name }}"/>
          <label for="username" style="padding-top:15px;">Change username</label>
            <input type="text" name="username" placeholder="{{ Auth::user()->username }}"/>
          <label style="padding-top:15px;">Change password</label>
            <input type="password" name="currentpassword" placeholder="Current password">
            <input type="password" name="newpassword" placeholder="New password" style="margin-top:10px;">
            <input type="password" name="newpassword_confirmation" placeholder="Verify new password" style="margin-top:10px;">
          <label style="padding-top:15px;">Change Email</label>
            <input type="text" name="changeemail" placeholder="{{Auth::user()->email}}">
          <input type="submit" class="btn btn-primary ajax" value="Save Changes">
        </form>

      </div>
    </div>
    <button class="card-toggle" data-toggle="collapse" data-target="#profile-settings" aria-expanded="false" aria-controls="collapseExample">
      <i class="fa fa-angle-double-down" aria-hidden="true"></i>
    </button>
  </div>

  <p>
    We temporarily removed the ability to upload and generate avatars. Zeb is too lazy to add the feature back in. (All he has to do is copy and paste.) XD
  </br>
    So have a look at this Day/Night time switch instead.
  </p>

  <form action="/toggleDarkness" method="POST">
    {{ csrf_field() }}
    @if (Auth::user()->isDark == 0)
      <input class="btn btn-primary" type="submit" value="Night Time!"></input>
    @else
      <input class="btn btn-primary" type="submit" value="Day Time!"></input>
    @endif
  </form>



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

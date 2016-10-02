@extends('emails.index')

@section('email')

<div class="jumbotron" style='background: white;'>
  <h1>Welcome!</h1>
  <p>Hey, <br>
  Thank you for joining Sniddl!  With the username of:<br>
  <b>{{$user->username}}</b><br>
  If you are still excited about our website, then click the verify link!</p>
  <p><a class="btn btn-primary btn-lg" href="{{URL::to('/verify/'.$user->username.'/'.$user->confirmation_code)}}" role="button">Verify My Account</a></p>
  <br>
  <p>
    If this is not you, or you changed your mind. Please click the cancel button
    (The one with a sad face). <br>
    Once clicked the account registered with this email will be deleted.
  </p>
  <p><a class="btn btn-danger btn-small" href="#" role="button">Cancel :(</a></p>
</div>

@endsection

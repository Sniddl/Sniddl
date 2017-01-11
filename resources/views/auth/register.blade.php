@extends('layouts.app')

@section('content')
<style media="screen">
  body{
    background: linear-gradient(263deg, #00ffbd, #7236de);
    background-size: 400% 400%;

    -webkit-animation: AnimationName 30s ease infinite;
    -moz-animation: AnimationName 30s ease infinite;
    -o-animation: AnimationName 30s ease infinite;
    animation: AnimationName 30s ease infinite;
  }
    @-webkit-keyframes AnimationName {
        0%{background-position:0% 86%}
        50%{background-position:100% 15%}
        100%{background-position:0% 86%}
    }
    @-moz-keyframes AnimationName {
        0%{background-position:0% 86%}
        50%{background-position:100% 15%}
        100%{background-position:0% 86%}
    }
    @-o-keyframes AnimationName {
        0%{background-position:0% 86%}
        50%{background-position:100% 15%}
        100%{background-position:0% 86%}
    }
    @keyframes AnimationName {
        0%{background-position:0% 86%}
        50%{background-position:100% 15%}
        100%{background-position:0% 86%}
    }
</style>
<div class="container">
    <div class="row">
      <div id="register-container">
        <form class="col-lg-8 offset-lg-2 col-md-8 offset-md-2" role="form" method="POST" action="{{ url('/register') }}">
            {{ csrf_field() }}
            <div class="form-group {{ $errors->has('name') ? ' has-error' : '' }}">
                  <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" placeholder="Name" required autofocus>
                  @if ($errors->has('name'))
                      <span class="help-block">
                          <strong>{{ $errors->first('name') }}</strong>
                      </span>
                  @endif
            </div>

            <div class="form-group {{ $errors->has('username') ? ' has-error' : '' }}">
                    <input id="username" type="text" class="form-control" name="username" placeholder="Username" required>
                    @if ($errors->has('username'))
                        <span class="help-block">
                            <strong>{{ $errors->first('username') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Email" required>
                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirm your password" required>
                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif
            </div>

            <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
                    <input id="phone" type="text" class="form-control" name="phone" placeholder="Phone" required>
                    @if ($errors->has('phone'))
                        <span class="help-block">
                            <strong>{{ $errors->first('phone') }}</strong>
                        </span>
                    @endif
            </div>
            <a href="{{ url('/login') }}" style="font-size: 12px; color:white;">Already have an account?</a>
        <!--<div class="form-group">
                <div class="col-md-6 col-md-offset-4">
                    <button type="submit" class="btn btn-primary">
                        Register
                    </button>
                </div>
            </div>-->
            <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
              <button type="submit" class="btn btn-outline-primary">Register</button>
            </div>
        </form>
      </div>

</div>
@endsection

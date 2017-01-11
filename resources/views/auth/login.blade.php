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

    <div id="login-container">
      <form class="col-lg-8 offset-lg-2 col-md-8 offset-md-2" action="{{ url('/login') }}" method="post">
        {{ csrf_field() }}
        <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email">Email Address</label>
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required autofocus>
                @if ($errors->has('email'))
                    <span class="help-block">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
        </div>

        <div class="form-group {{ $errors->has('password') ? ' has-error' : '' }}">
                <label for="password">Password</label>
                <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

                @if ($errors->has('password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
        </div>

        <div class="input-group">
                <div class="checkbox" style="">
                        <input type="checkbox" name="remember"> Remember Me</input>
                        <a class="btn btn-link " href="{{ url('/password/reset') }}" style="font-size: 12px; color:white;">
                            Forgot Your Password?
                        </a>
                </div>

        </div>

        <a href="{{ url('/register') }}" style="font-size: 12px; color:white;">Don't have an account?</a>

        <div class="form-group {{ $errors->has('phone') ? ' has-error' : '' }}">
          <button type="submit" class="btn btn-outline-primary">Login</button>
        </div>
      </form>
    </div>

  </div>
</div>
@endsection

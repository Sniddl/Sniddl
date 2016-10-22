@extends('layouts.app')

@section('content')

<style media="screen">
  .form-group>div {
    margin-bottom: 10px;
  }
</style>

<div class="container">
  <div class="row">

    <div class="col-md-8 offset-md-2" >
      <p class="col-md-6 offset-md-4" >
        Login to Sniddl
      </p>
      <form  method="POST" action="{{ url('/login') }}">
          {{ csrf_field() }}

          <div class="form-group {{ $errors->has('email') ? ' has-error' : '' }}">
              <div class="col-md-6 offset-md-4">
                  <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required autofocus>

                  @if ($errors->has('email'))
                      <span class="help-block">
                          <strong>{{ $errors->first('email') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
              <div class="col-md-6 offset-md-4">
                  <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

                  @if ($errors->has('password'))
                      <span class="help-block">
                          <strong>{{ $errors->first('password') }}</strong>
                      </span>
                  @endif
              </div>
          </div>

          <div class="form-group">
              <div class="col-md-6 offset-md-4" >
                  <div class="checkbox" style="font-size: 12px">
                      <div>
                          <input type="checkbox" name="remember"> Remember Me
                          <a class="btn btn-link " href="{{ url('/password/reset') }}" style="font-size: 12px">
                              Forgot Your Password?
                          </a>
                      </div>

                  </div>
              </div>
          </div>


          <div class="form-group">
              <div class="col-md-6 offset-md-4 " >
                <button type="submit" class="btn btn-primary" style="width: 100%;">
                    Login
                </button>
              </div>
          </div>

          <div class="form-group">
              <div class="col-md-6 offset-md-4 " >
                <a href="/register"> Don't have an account?</a>
              </div>
          </div>


      </form>
    </div>
  </div>
</div>
@endsection

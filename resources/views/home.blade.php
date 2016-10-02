@extends('layouts.app')


@section('content')

            @if (Auth::user())
              @if(Session::has('verify_success'))
                <div class="alert alert-success alert-dismissible" role="alert"><div  type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></div>
                  <strong>Success:</strong>
                  {{Session::get('verify_success')}}
                </div>

              @elseif(Session::has('verify_fail'))
                <div class="alert alert-danger" role="alert">
                  <strong>Error:</strong>
                  {{Session::get('verify_fail')}}
                  <a href="/resendVerification">Click here</a> to resend the email.
                </div>
              @elseif(Session::has('verify_incomplete'))
                <div class="alert alert-info alert-dismissible" role="alert"><div  type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></div>
                  <strong>Confirmation Needed:</strong>
                  {{Session::get('verify_incomplete')}}
                  <a href="/resendVerification">Click here</a> to resend the email.
                </div>

              @endif

              
              @if(Session::has('notify_danger'))
                <div class="alert alert-danger alert-dismissible" role="alert"><div  type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></div>
                  <strong>Warning:</strong>
                  {{Session::get('notify_danger')}}
                </div>
              @endif

                @yield('edit')
            @else
            <div class="alert alert-warning">
              <strong>Uh-Oh:</strong>   You aren't logged into our website! <a href="/login">Login</a> or <a href="register"> Register</a> to join the fun!
            </div>


            @endif



            @yield('posts')






@endsection

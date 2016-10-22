@extends('layouts.app')


@section('content')

            @if (Auth::check())
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

                  <div class="container">
                    @yield('posts')
                    @yield('edit')
                  </div>
            @else

                  <div class="alert alert-danger alert-dismissible fade in" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Notice:</strong>   Sniddl has been updated. As a result, all accounts have been deleted.
                  </div>

                  <div class="jumbotron jumbotron-fluid">
                    <div class="container">
                      <h1 class="display-3">Welcome to Sniddl.</h1>
                      <p class="lead">Sniddl is a social network in development. If you are seeing this right now you are an official Alpha-tester, Congratulations!! As of now we can't tell you much because either our ideas are too good for the world to hear, or we don't actually have any ideas and we need some BS to fill this page. </p>
                      <hr class="m-y-2">
                      <p>If you would like to help test this website, in its early stages of life, feel free to click one of these buttons.</p>
                      <p class="lead">
                        <a class="btn btn-primary btn-lg" href="/login" role="button">Login</a>
                        <a class="btn btn-primary btn-lg" href="/register" role="button">Register</a>
                      </p>

                    </div>
                  </div>


            @endif










@endsection

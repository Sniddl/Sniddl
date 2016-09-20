@extends('layouts.app')


@section('content')

            @if (Auth::user())
              @if(Auth::user()->newbieNotifications != 1)
                <div class="alert alert-success alert-dismissible" role="alert"><a href="/toggleNewbieNotifications" type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></a>

                  <strong>Registration Complete:</strong> Thank you for joing Sniddl. Click where it says <strong><u>{{ Auth::user()->name }}</u></strong> to view some options.

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

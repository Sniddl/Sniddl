@extends('layouts.app')


@section('content')

            @if (Auth::user())
                <div class="alert alert-success alert-dismissible" role="alert">
                  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  <strong>Registration Complete:</strong> Thank you for joing Sniddl. Click where it says <strong><u>{{ Auth::user()->name }}</u></strong> to view some options.
                </div>
                @yield('posts')
            @else
                Don't want to miss out? <a href="/login">Login</a> or <a href="register"> Register</a> to join the fun!
            @endif



@endsection

<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Sniddl - Created by Zeb and Sys">
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>Pre-Alpha Sniddl</title>





<!-- FONTS -->
<!-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700"> -->

<!-- CSS -->
<link href="{{ asset('css/dependencies.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('css/light.css') }}" rel="stylesheet" type="text/css" >
@if(Auth::check() && Auth::user()->isDark == 1)
  <link href="{{ asset('css/dark.css') }}" rel="stylesheet" type="text/css" >
@endif

<!-- JS -->
<script src="{{asset('js/dependencies.js')}}" charset="utf-8"></script>
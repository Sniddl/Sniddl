<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Sniddl - Created by Zeb and Sys">
<meta name="csrf-token" content="{{ csrf_token() }}">
@if (Auth::check())
<meta name="uid" content="{{ Auth::user()->id }}">
@endif
<title>Pre-Alpha Sniddl</title>



<!-- CSS -->
<!-- <link href="{{ asset('css/dependencies.css') }}" rel="stylesheet" type="text/css" >
<link href="{{ asset('css/light.css') }}" rel="stylesheet" type="text/css" > -->
<link href="https://fonts.googleapis.com/css?family=Lato:400,700" rel="stylesheet">

<!-- JS -->
<script src="https://cdn.socket.io/socket.io-1.4.5.js"></script>
<script src="{{asset('js/dependencies.js')}}" charset="utf-8"></script>

</head>

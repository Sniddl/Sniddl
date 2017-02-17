<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Laravel') }}</title>

<!-- Styles -->
<link href="/css/semantic.css" rel="stylesheet">
<link href="/css/app.css" rel="stylesheet">
<link href="/css/temp.css" rel="stylesheet">
<!-- <link href="/semantic/semantic.min.css" rel="stylesheet"> -->

<!-- Scripts -->
<script>
    window.Laravel = {!! json_encode([
        'csrfToken' => csrf_token(),
    ]) !!};

window.__SNIDDL_AJAX__ = {
  data: {!! json_encode([
      '_token' => csrf_token(),
  ]) !!}
};
</script>
<script type="text/javascript" src="/js/bootstrap.js"></script>

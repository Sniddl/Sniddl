@extends('layouts.app')

@section('content')
  <?php $getCommunity = \App\Community::where('url','=',Request::segment(2))->first()?>
{{--$getCommunity gets the relevant information depending on the URL entered.--}}
{{--$owner gets the relevant information on the owner of the community.--}}

@endsection

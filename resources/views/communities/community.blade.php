@extends('layouts.app')
@section('community')

<div class="container">

    <?php $getCommunity = \App\Community::where('url','=',Request::segment(2))->first()?>

    <h3 style="color:black;">{{$getCommunity->name}}</h3>




</div>

@endsection

@extends('welcome')
@section('edit')

@if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container">
  <img class="img-circle" height="100px" src="{{ Auth::user()->avatar }}"/>
  <h1>Editing {{ Auth::user()->username }}'s profile...</h1>




  <form class="" action="/edit/profile/avatargen" method="POST">
    <label>Generate Profile Picture</label><br>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" class="btn btn-sm btn-primary" value="Generate">
  </form>

  @yield('generateAvatar')
  <br><br>
  <form class="" enctype="multipart/form-data" action="/edit/profile/avatar" method="POST">
    <label>Update Profile Image</label>
    <input type="file" name="avatar"><br>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="submit" class="btn btn-sm btn-primary" value="Upload">
  </form>
</div>



@endsection

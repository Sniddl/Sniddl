<div class="welcome-form login">
  <form class="ui form" role="form" method="POST" action="{{ url('/login') }}">
    {{ csrf_field() }}
    <div class="field">
      <label>Username</label>
      <input type="text" name="first-name" placeholder="Enter your username">
    </div>
    <div class="field">
      <label>Password</label>
      <input type="password" name="last-name" placeholder="Enter your password">
    </div>
    <div class="field"><button class="tiny ui button" type="submit">Sign In</button></div>
  </form>
</div>

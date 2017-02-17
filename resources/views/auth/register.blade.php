<div class="welcome-form login">
  <form class="ui form" role="form" method="POST" action="/register">
    {{ csrf_field() }}
    <div class="field">
      <label>Name</label>
      <input type="text" name="display_name" placeholder="Enter your name">
    </div>
    <div class="field">
      <label>Username</label>
      <input type="text" name="username" placeholder="Enter a username">
    </div>
    <div class="field">
      <label>Email</label>
      <input type="email" name="email" placeholder="Enter your email">
    </div>
    <div class="field">
      <label>Password</label>
      <input type="password" name="password" placeholder="Enter a password">
    </div>
    <div class="field">
      <label>Confirm Password</label>
      <input type="password" name="password_confirmation" placeholder="Confirm the password">
    </div>
    <div class="field"><button class="tiny ui button" type="submit">Sign Up</button></div>
  </form>
  <!-- <form class="ui form" role="form" method="POST" action="{{ url('/register') }}">
    {{ csrf_field() }}
    <div class="field">
      <label>Name</label>
      <input type="text" name="display_name" placeholder="Enter your name">
    </div>
    <div class="field">
      <label>Username</label>
      <input type="text" name="username" placeholder="Enter a username">
    </div>
    <div class="field">
      <label>Email</label>
      <input type="email" name="email" placeholder="Enter an email">
    </div>
    </div>
    <div class="field">
      <label>Password</label>
      <input type="password" name="password" placeholder="Enter a password">
    </div>
    <div class="field">
      <label>Confirm password</label>
      <input type="password" name="password_confirmation" placeholder="Confirm your password">
    </div>
    <div class="field"><button class="tiny ui button" type="submit">Sign Up</button></div>
  </form> -->
</div>

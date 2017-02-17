<div class="welcome-form login">
  <form class="ui form" role="form" method="POST" action="/login">
    {{ csrf_field() }}
    <div class="field">
      <label>Email</label>
      <input type="text" name="email" placeholder="Enter your email">
    </div>
    <div class="field">
      <label>Password</label>
      <input type="password" name="password" placeholder="Enter your password">
    </div>
    <div class="field"><button class="tiny ui button" type="submit">Sign In</button></div>
  </form>
</div>

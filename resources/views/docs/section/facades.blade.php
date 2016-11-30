<div class="container">
  <h1>Database Facades</h1>
  <p>Use these functions with your table class instance to quickly access commonly used queries. The source code for these functions are located within the table class file.</p>
  <a class="h5" data-toggle="collapse" href="#user-facades" aria-expanded="false" aria-controls="user-facades">
    User
  </a>
  <div class="collapse" id="user-facades">
    <pre>
      <span class="custom-tooltip" data-toggle="tooltip" data-placement="right" title="Access all the posts linked to a User.">Posts();</span>
      <span class="custom-tooltip" data-toggle="tooltip" data-placement="right" title="Access all the friends linked to a User.">Friends();</span>
      <span class="custom-tooltip" data-toggle="tooltip" data-placement="right" title="Access all the followers linked to a User.">Followers();</span>
      <span class="custom-tooltip" data-toggle="tooltip" data-placement="right" title="Access all the Users that a User is following.">Following();</span>
      <span class="custom-tooltip" data-toggle="tooltip" data-placement="right" title="Access all the events in the timeline that are linked to a User.">Timeline();</span>
      <span class="custom-tooltip" data-toggle="tooltip" data-placement="right" title="Access all the reposts linked to a User.">Reposts();</span>
      <span class="custom-tooltip" data-toggle="tooltip" data-placement="right" title="Check if current user is a friend of the Auth::user().">AuthFriend();</span>
      <span class="custom-tooltip" data-toggle="tooltip" data-placement="right" title="Check if a column in the User table is equal to a parameter in the url. Where $column is the name of the column in the database and $index is the index of the url paramater.">GetRequest($column, $int);</span>
      <span class="custom-tooltip" data-toggle="tooltip" data-placement="right" title="Access all the communities that a User owns.">OwnerOf();</span></pre>
  </div>

  <pre>
    <code class="HTML">
      <!-- PHP -->
      &lt;?php $posts = User::Posts()->get(); ?>

      <!-- Blade -->
      @@foreach($posts as $post)
        <p>@{{$post->text}}</p>
      @@endforeach
    </code>
  </pre>

</div>

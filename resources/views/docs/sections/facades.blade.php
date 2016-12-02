@extends('docs.index')

@section('docs')
<div class="container">
  <h1>Model Facades</h1>
  <p>Use these functions with your table class instance to quickly access commonly used queries. The source code for these functions are located within the table class file.</p>
  <a class="h5" data-toggle="expand" href="#community-facades" aria-expanded="false" aria-controls="#community-facades">Community</a>
  <a class="h5" data-toggle="expand" href="#post-facades" aria-expanded="false" aria-controls="#post-facades">Post</a>
  <a class="h5" data-toggle="expand" href="#timeline-facades" aria-expanded="false" aria-controls="#timeline-facades">Timeline</a>
  <a class="h5 active" data-toggle="expand" href="#user-facades" aria-expanded="false" aria-controls="#user-facades">User</a>


  <div class="expand" id="community-facades">
    <pre>
      <div class="expand-content">
        <span class="custom-tooltip" data-toggle="tooltip" data-placement="right" title="Retrieve all the posts for this community.">Posts();</span>
        <span class="custom-tooltip" data-toggle="tooltip" data-placement="right" title="Access the User that is the owner for this community.">Owner();</span>
      </div>
      <code class="HTML">
        <!-- PHP -->
        &lt;?php  $community = Community::where( 'name', '=', Request::segment(2) ); // returns: "Soccer"  ?>

        <!-- Blade -->
        <h1 class="community-title">@{{$community->name}}->name</h1>
        <h3 class="community-owner">@{{$community->Owner()->displayname ."| @". @{{$community->Owner()->username}}->name</h1>

        <!-- Returns -->
        <h1 class="community-title">Soccer</h1>
        <h3 class="community-owner">Joe | @Joe_is_King</h1>
      </code>
    </pre>
  </div>

  <div class="expand" id="post-facades">
    <pre>
      <div class="expand-content">
        <span class="custom-tooltip" data-toggle="tooltip" data-placement="right" title="Retrieve all the likes for this post.">Likes();</span>
        <span class="custom-tooltip" data-toggle="tooltip" data-placement="right" title="Retrieve all the reposts for this post.">Reposts();</span>
        <span class="custom-tooltip" data-toggle="tooltip" data-placement="right" title="Access the user who made this post.">User();</span>
      </div>

      <code class="HTML">
        <!-- PHP -->
        &lt;?php $post = Post::find(1); ?>

        <!-- Blade -->
        <span class="icon like" data-id="@{{$post->id}}" >
          <i class="fa fa-heart"></i> @{{ $post->likes()->count() }}
        </span>

        <!-- Returns -->
        <span class="icon like" data-id="1" >
          <i class="fa fa-heart"></i> 17
        </span>
      </code>
    </pre>
  </div>

  <div class="expand" id="timeline-facades">
    <pre>
      <div class="expand-content">
        <span class="custom-tooltip" data-toggle="tooltip" data-placement="right" title="Get the Post linked to the event in the timeline.">Post();</span>
        <span class="custom-tooltip" data-toggle="tooltip" data-placement="right" title="Access the User who added the event to the timeline.">AddedBy();</span>
      </div>
      <code class="HTML">
        <!-- PHP -->
        &lt;?php $timeline = Timeline::get(); ?>

        <!-- Blade -->
        @@foreach ($timeline as $event)
          @@if($event->is_repost)
            <a href="/u/@{{$event->AddedBy()->username}}">@{{$event->AddedBy()->display_name}} reposted...</a>
          @@endforeach
        @@endforeach

        <!-- Returns -->
        <a href="/u/Joe">Joe_is_King reposted...</a>
      </code>

    </pre>
  </div>

  <div class="expand default-tab" id="user-facades">
    <pre>
      <div class="expand-content">
        <span class="custom-tooltip" data-toggle="tooltip" data-placement="right" title="Access all the posts linked to a User.">Posts();</span>
        <span class="custom-tooltip" data-toggle="tooltip" data-placement="right" title="Access all the friends linked to a User.">Friends();</span>
        <span class="custom-tooltip" data-toggle="tooltip" data-placement="right" title="Access all the followers linked to a User.">Followers();</span>
        <span class="custom-tooltip" data-toggle="tooltip" data-placement="right" title="Access all the Users that a User is following.">Following();</span>
        <span class="custom-tooltip" data-toggle="tooltip" data-placement="right" title="Access all the events in the timeline that are linked to a User.">Timeline();</span>
        <span class="custom-tooltip" data-toggle="tooltip" data-placement="right" title="Access all the reposts linked to a User.">Reposts();</span>
        <span class="custom-tooltip" data-toggle="tooltip" data-placement="right" title="Check if current user is a friend of the Auth::user().">AuthFriend();</span>
        <span class="custom-tooltip" data-toggle="tooltip" data-placement="right" title="Check if a column in the User table is equal to a parameter in the url. Where $column is the name of the column in the database and $index is the index of the url paramater.">GetRequest($column, $int);</span>
        <span class="custom-tooltip" data-toggle="tooltip" data-placement="right" title="Access all the communities that a User owns.">OwnerOf();</span>
      </div>
      <code class="HTML">
        <!-- PHP -->
        &lt;?php $posts = User::Posts()->get(); ?>

        <!-- Blade -->
        @@foreach($posts as $post)
          <p>@{{$post->text}}</p>
        @@endforeach

        <!-- Returns -->
        <p>Lorem ipsum dolor sit amet.</p>
      </code>
    </pre>

  </div>







</div>
@endsection

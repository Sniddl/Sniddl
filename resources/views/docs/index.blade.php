@include('head')

<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.8.0/styles/atom-one-dark.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/9.8.0/highlight.min.js"></script>
<script src="/js/docs/load.js" charset="utf-8"></script>

<link rel="stylesheet" href="/css/docs.css" media="screen" title="no title">


<div class="sidebar">
  <ul>
    <li>
      <a href="/docs/helpers" class="header">Helper Functions</a>
      <ul>
        <li><a href="/docs/helpers#authenicate-devloper" class="list-item">Authenicate Devloper</a></li>
        <li><a href="/docs/helpers#generate-hexadecimal" class="list-item">Generate Hexadecimal</a></li>
        <li><a href="/docs/helpers#hexadecimal-info" class="list-item">Hexadecimal Info</a></li>
        <li><a href="/docs/helpers#post-parsing" class="list-item">Post Parsing</a></li>
      </ul>
    </li>

    <li>
      <a href="/docs/model-facades" class="header">Model Facades</a>
      <ul>
        <li><a href="/docs/model-facades#community-facades" class="list-item">Community</a></li>
        <li><a href="/docs/model-facades#post-facades" class="list-item">Post</a></li>
        <li><a href="/docs/model-facades#timeline-facades" class="list-item">Timeline</a></li>
        <li><a href="/docs/model-facades#user-facades" class="list-item">User</a></li>
      </ul>
    </li>

  </ul>
</div>



<div class="docs">
  @yield('docs')
</div>

<script src="/js/docs/syntax.js" charset="utf-8"></script>

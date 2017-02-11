@include('layouts.head')

<style media="screen">
  span.artist-info {
    position: absolute;
    width: 100%;
    bottom: 4px;
    right: 0;
    padding: 10px;
    padding-top: 18px;
    color: white;
    background-image: linear-gradient(to top, rgba(0, 0, 0, 0.61) 30%, transparent);
  }
  span.artist-info a {
    color: white;
    text-decoration: underline;
    font-style: italic;
}
span.artist-info a:hover {
    opacity: 0.7;
}
</style>
<div class="img-of-the-day" style="width:400px; position: relative">
  <img style="width:100%">
  <span class="artist-info">
    Photo by
    <a id="img-of-the-day-artist" target="_blank"></a>
    / <a href="https://unsplash.com">Unsplash</a>
  </span>
</div>

<script type="text/javascript">

  $('.img-of-the-day').ready(function(){
    $.ajax({
      type: 'GET',
      url: '/api/remote/get/unsplash_random',
      headers: {
        'X-CSRF-TOKEN': window.Laravel.csrfToken,
        'AJAX': true
      },
      success: function s(data) {
        $('.img-of-the-day img').attr('src', data.json.urls.full)
        $('#img-of-the-day-artist')
          .attr('href', "https://unsplash.com/@"+data.json.user.username)
          .html(data.json.user.first_name + " " + data.json.user.last_name);
      },
      error: function e(data){}
    });
  })

  function create_img(src) {
    $('img').attr("src", src);
  }
</script>

@include('layouts.foot')

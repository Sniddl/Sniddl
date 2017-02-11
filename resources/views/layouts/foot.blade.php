<!-- Scripts -->
<script type="text/javascript" src="/js/app.js"></script>
<script type="text/javascript" src="/semantic/semantic.min.js"></script>
<script type="text/javascript">
$('.menu .item').click(function(){
  $('.menu .item').removeClass('active');
  $('.tab').removeClass('active');
  $(this).addClass('active')
  var target = $(this).data('tab');
  $(target).addClass('active')
})

$('.fa-close').click(function(){
  $(this).parent().hide();
});
</script>

<script type="text/javascript">
  $('document').ready(function(){
    if(base_url_is('login') || base_url_is('register')){

      //execute this if url match /register or /login


      $('.img-of-the-day').ready(function(){
        $.ajax({
          type: 'GET',
          url: '/api/remote/get/unsplash_random',
          headers: {
            'X-CSRF-TOKEN': window.Laravel.csrfToken,
            'AJAX': true
          },
          success: function s(data) {
            $('.img-of-the-day-artist')
              .attr('href', "https://unsplash.com/@"+data.json.user.username)
              .html(data.json.user.first_name + " " + data.json.user.last_name);
            $('.img-of-the-day').css('background-image','url("'+data.json.urls.full+'")')
            $('.artist-info').show()
          },
          error: function e(data){}
        });
      })

      function create_img(src) {
        $('img').attr("src", src);
      }



    }
  })







</script>

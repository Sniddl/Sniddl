@extends('docs.index')

@section('docs')
<div class="container">
  <h1>Helper Functions</h1>
  <p>Use these global methods anywhere when using php. If you see a random method and you don't know where it came from, odds are it is probably a helper function. To make a helper function simply paste your function into the App\Helper.php directory.</p>
  <a class="h5" data-toggle="expand" href="#authenicate-devloper" aria-expanded="false" aria-controls="#authenicate-devloper">Authenicate Devloper</a>
  <a class="h5" data-toggle="expand" href="#generate-hexadecimal" aria-expanded="false" aria-controls="#generate-hexadecimal">Generate Hexadecimal</a>
  <a class="h5" data-toggle="expand" href="#hexadecimal-info" aria-expanded="false" aria-controls="#hexadecimal-info">Hexadecimal Info</a>
  <a class="h5 active" data-toggle="expand" href="#post-parsing" aria-expanded="false" aria-controls="#post-parsing">Post Parsing</a>


  <div class="expand" id="authenicate-devloper">

      <div class="expand-content">
        By using this function, you can quickly determine if the user that is currently signed in is a registered developer. This function is very simple to use. Simply call the function to recieve a boolean stating whether the Auth is or is not a developer.
      </div>
      <pre>
      <code class="PHP">
        if( is_dev() ){
          return view('docs.sections.facades');
        }else {
          abort(404);
        }
      </code>
    </pre>
  </div>


  <div class="expand" id="generate-hexadecimal">

      <div class="expand-content">
        If you have ever wanted to quickly generate a hexadecimal string, then you are in luck. With this function you can create a random hexidecimal string and if you use the option of "#" it will include a "#" on the front of the string. This is great for making random colors.
      </div>
      <pre>
      <code class="PHP">
        $noHash = generateHex();
        $hash = generateHex("#");

        $user                        =  User::find(1);
        $user->background_color      =  $hash;
        $user->favorite_hexadecimal  =  $nohash;
        $user->save();
      </code>
    </pre>
  </div>

  <div class="expand" id="hexadecimal-info">
      <div class="expand-content">
        If you generated a hexadecimal string or you have a hex color ready, then you can get info about the hex using this function. The first parameter is the hex and the second parameter is the method. If the method is left blank, then you recieve an array with the rgb values.
      </div>
      <pre>
      <code class="PHP">
        $hex = generateHex();

        //With method
        if (hexInfo($hex, 'contrast') > 130) {
          echo 'This is a bright color.<br>';
        }else {
          echo 'This is a dark color.<br>';
        }

        //Without method
        $colors = hexInfo($hex); // ['r '=> 140, 'g' => 220, 'b' => 98]
        foreach ($colors as $key => $color){
          echo $key." = ".$color."<br>";
        }

      </code>

    </pre>
  </div>

  <div class="expand default-tab" id="post-parsing">

      <div class="expand-content">
        This function will iterate through a post's text removing white spaces and inserting links.
      </div>
      <pre>
        <code class="HTML">
          <!-- PHP -->
          &lt;?php $posts = User::Posts()->get(); ?>

          <!-- Blade -->
          @@foreach($posts as $post)
            <div class="card-text card-item">
              @{{ parse_post($post->text) }}
            </div>
          @@endforeach

        </code>
      </pre>

  </div>







</div>
@endsection

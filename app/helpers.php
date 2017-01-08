<?php
// My common functions


function generateHex($hash = null)
{
    $hex = dechex(rand(0, 16777215));
    $hex = str_pad($hex, 6, "0", STR_PAD_LEFT);
    if ($hash == "#") {
        return '#'.$hex;
    }
    return $hex;
}


function hexInfo($hex, $method = null)
{
    $r = hexdec(substr($hex, 0, 2));
    $g = hexdec(substr($hex, 2, 2));
    $b = hexdec(substr($hex, 4, 2));

    switch ($method) {
        case 'contrast':
            return sqrt($r * $r * .241 +
                  $g * $g * .691 +
                  $b * $b * .068);
        break;

        default:
            return [
        'r '=> $r,
        'g' => $g,
        'b' => $b,
            ];
    }
}


function parse_post($target)
{

    $rules = [
    '@' => '/(?<!\S)[@]+[a-zA-Z0-9\_\-]*/',
    '+' => '/(?<!\S)[+]+[a-zA-Z0-9\_\-]*/'
    ];

    foreach ($rules as $key => $rule) {
        preg_match_all($rule, $target, $matches);
        foreach ($matches[0] as $match) {
            $substr = substr($match, 1);
            switch ($key) {
                case '@':
                    $user = User::where('username', '=', $substr)->first();
                    if ($user) {
                        $target = str_replace_first($match, "<a href='/u/$substr'>@".$user->display_name.'</a>', $target);
                    }
                    break;
                case '+':
                    $community = 'community will go here eventually';
                    if ($community) {
                        $target = str_replace_first($match, "<a href='/c/$substr'>+".$substr.'</a>', $target);
                    }
                    break;

                default:
                    throw new Exception("WTF! This can't be good. App\helpers @parse_post");
                break;
            }
        }
    }


    return $target;
}

function email_signup($user)
{
  //$user = Auth::user();//User::where('email','=', $data['email'])->first();

    Mail::send('emails.signup', ['user' => $user], function ($m) use ($user) {
        $m->from('noreply@sniddl.com', 'Sniddl');

        $m->to($user->email, $user->name)->subject('Sniddl Confirmation');
    });
}

function is_dev(){
  try {
    $auth = Auth::user()->id;
    $dev = DB::table('devs')->where('user_id','=',$auth);
    return $dev->exists();
  } catch (Exception $e) {
    return false;
  }


}



function upload_image($path, $prefix, $storage_path, $width, $height){
  $extention = $path->getClientOriginalExtension();
  // Format of the date() is "date, month, year, hour(12hr), minutes, seconds" **The date is based on machine time**
  $filename = $prefix.'_' . date("jFYhis") . '.' . $extention;
  Image::make($path)->fit($width,$height)->save(public_path($storage_path . $filename));
  return $storage_path.$filename;

  // ---------------------------------------------------------
  // DO NOT DELETE!! THIS IS CODE FOR SAVING TO STORAGE!!
  // ---------------------------------------------------------
      // $path   = $request->file('avatar');
      // $resize = Image::make($path)->fit(300)->encode('jpg');
      // $hash   = md5( $resize->__toString() );
      // $path   = "uploads/avatars/{$hash}.jpg";
      // $resize->save(public_path($path));
      // $url    = "/" . $path;
      // Storage::put('public/image/myUniqueFileNameHere.jpg', $resize->__toString());
}
/**
 *
 */
// class Upload
// {
//   var $path;
//   var $prefix;
//   var $storage;
//   var $width;
//   var $height;
//
//   function __construct($path)
//   {
//     dd($path);
//   }
// }

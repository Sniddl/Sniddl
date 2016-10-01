<?php
// My common functions


function generateHex($hash=null){
  $hex = dechex(rand(0, 16777215));
  $hex = str_pad($hex, 6, "0", STR_PAD_LEFT);
  if ($hash == "#"){
    return '#'.$hex;
  }
  return $hex;
}


function hexInfo($hex, $method=null){
  $r = hexdec(substr($hex,0,2));
  $g = hexdec(substr($hex,2,2));
  $b = hexdec(substr($hex,4,2));

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


function check( $table, $parameter1=null, $parameter2=null ){
  switch ($table) {
    case 'Friend':
      return 'following';
      break;

    default:
      throw new Exception("Table not found.");
      break;
  }
}




?>

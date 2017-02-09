<?php


use Carbon\Carbon;

function rand_64($length){
  return substr(base64_encode(sha1(mt_rand())), 0, $length);
}


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


function noMicroseconds(){
  $now = Carbon::now();
  return Carbon::create($now->year, $now->month, $now->day, $now->hour, $now->minute, $now->second);
}

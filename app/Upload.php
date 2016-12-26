<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Intervention\Image\Facades\Image;

class Upload
{
    public $path;
    public $previx;
    public $storage;
    public $width;
    public $height;



    public function upload(){
        $extention = $this->path->getClientOriginalExtension();
        // Format of the date() is "date, month, year, hour(12hr), minutes, seconds" **The date is based on machine time**
        $filename = $this->prefix.'_' . date("jFYhis") . '.' . $extention;
        Image::make($this->path)->fit($this->width,$this->height)->save(public_path($this->storage . $filename));
        return $this->storage.$filename;
    }

}

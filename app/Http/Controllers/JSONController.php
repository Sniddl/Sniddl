<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\JSON;

class JSONController extends Controller
{
    public function get(Request $request, $site){
      $request->request->add([
        'json'=> JSON::get($site),
      ]);
      return back();
    }
}

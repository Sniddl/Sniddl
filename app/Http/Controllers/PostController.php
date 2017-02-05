<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{

  private $request;

  public function __construct(Request $request)
  {
      $this->request = $request;
  }


  public function create() {
    dd($this->request);
  }
}

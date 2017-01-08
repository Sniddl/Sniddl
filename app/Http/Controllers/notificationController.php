<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class notificationController extends Controller
{
    public function each()
    {
      foreach (Auth::user()->unreadNotifications as $notification) {
          $notification->markAsRead();
      }
      return view('notifications');
    }
}

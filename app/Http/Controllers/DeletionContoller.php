<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


use App\Post;
use App\Repost;
use App\Timeline;

class DeletionContoller extends Controller
{

    public function delete()
    {
        $item = request()->item;
        $id = request()->id;


        switch ($item) {
            case 'post':
                Post::destroy($id);
                Repost::where('post_id', '=', $id)->delete();
                Timeline::where('post_id', '=', $id)->delete();
                return back();
            break;

            case 'user':
                //code
                break;


            default:
                throw new Exception("Make sure you define the item and the id of the item you are deleting.");
            break;
        }
    }
}

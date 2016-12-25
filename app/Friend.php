<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Friend extends Model
{
    public function user_being_followed()
    {
        return User::where("id", '=', $this->being_followed_id)->first();
    }

    public function follower()
    {
        return User::where("id", '=', $this->follower_id)->first();
    }
}

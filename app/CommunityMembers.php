<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommunityMembers extends Model
{
      protected $fillable = ['user_id', 'comm_id','created_at'];
      protected $table = 'community_members';
}

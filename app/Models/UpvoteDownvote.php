<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UpvoteDownvote extends Model
{
    protected $fillable = ['is_upvoted', 'post_id', 'user_id'];
}

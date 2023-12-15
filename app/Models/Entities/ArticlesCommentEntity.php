<?php

namespace App\Models\Entities;

use Franzose\ClosureTable\Models\Entity;
use App\Models\Entities\ArticlesCommentClosure;

class ArticlesCommentEntity extends Entity
{
    protected $table = 'articles_comments';
    // public function user()
    // {
    //     return $this->belongsTo(\App\Models\User::class);
    // }

    // public function article()
    // {
    //     return $this->belongsTo(\App\Models\Article::class);
    // }
}

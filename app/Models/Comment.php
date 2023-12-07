<?php

namespace App\Models;

use Franzose\ClosureTable\Models\Entity;

class Comment extends Entity
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'articles_comments';

    /**
     * ClosureTable model instance.
     *
     * @var \App\Model\CommentClosure
     */
    protected $closure = 'App\Model\CommentClosure';
}

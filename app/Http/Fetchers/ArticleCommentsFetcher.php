<?php

declare(strict_types=1);

namespace App\Http\Fetchers;

use App\Models\ArticlesComment;

class ArticleCommentsFetcher
{
    public function getListArray($articleId)
    {
        return ArticlesComment::where('article_id', $articleId)
        ->orderby('id','desc')
        ->get();
    }
}

<?php

declare(strict_types=1);

namespace App\Http\Fetchers;

use App\Models\ArticlesComment;

class ArticleCommentsFetcher
{
    public function getFirstReplicas($articleId)
    {
        return ArticlesComment::where('article_id', $articleId)
        ->whereNull('parent_id')
        ->orderby('position', 'asc')
        ->orderby('id', 'asc')
        ->get();
    }
    public function getReplicas($articleId, $parentId)
    {
        return ArticlesComment::where('article_id', $articleId)
        ->whereNotNull('parent_id')
        ->where('parent_id', $parentId)
        ->orderby('position', 'asc')
        ->orderby('id',' asc')
        ->get();
    }
}

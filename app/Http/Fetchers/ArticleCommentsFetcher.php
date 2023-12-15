<?php

declare(strict_types=1);

namespace App\Http\Fetchers;

use App\Models\ArticlesComment;

class ArticleCommentsFetcher
{
    //     public function getFirstReplicas($articleId)
    //     {
    //         return ArticlesComment::where('article_id', $articleId)
    //         ->whereNull('parent_id')
    //         ->orderby('position', 'asc')
    //         ->orderby('id', 'asc')
    //         ->get();
    //     }
    //     public function getReplicas($articleId, $parentId)
    //     {
    //         return ArticlesComment::where('article_id', $articleId)
    //         ->whereNotNull('parent_id')
    //         ->where('parent_id', $parentId)
    //         ->orderby('position', 'asc')
    //         ->orderby('id',' asc')
    //         ->get();
    //     }

    public function getCombinedReplicas($articleId)
    {
        // Отримуємо перші репліки
        $firstReplicas = ArticlesComment::select(
            'id',
            'article_id',
            'user_id',
            'parent_id',
            'body',
            'created_at'
        )
            ->where('article_id', $articleId)
            ->whereNull('parent_id')
            ->orderBy('position', 'asc')
            ->orderBy('id', 'asc')
            ->get();

        // We get child replicas for each first replica
        foreach ($firstReplicas as $replica) {
            $replica->replicas = $this->getReplicas($articleId, $replica->id);
        }

        return $firstReplicas;
    }

    public function getReplicas($articleId, $parentId)
    {
        return ArticlesComment::where('article_id', $articleId)
            ->whereNotNull('parent_id')
            ->where('parent_id', $parentId)
            ->orderBy('position', 'asc')
            ->orderBy('id', 'asc')
            ->get();
    }
}

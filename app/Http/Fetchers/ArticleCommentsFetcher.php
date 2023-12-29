<?php

declare(strict_types=1);

namespace App\Http\Fetchers;

use App\Models\ArticlesComment;
use App\Http\Fetchers\OrderByDTO;

class ArticleCommentsFetcher
{
    public function getCombinedReplicas(int $articleId, OrderByDTO $ordering)
    {
        if (!isset($ordering->userName)) {$ordering->userName = 'asc';}
        if (!isset($ordering->email)) {$ordering->email = 'asc';}
        if (!isset($ordering->createdAt)) {$ordering->createdAt = 'desc';}
        if (!isset($ordering->selected)) {$ordering->selected = 'userName';}

        $firstReplicas = ArticlesComment::select(
            'articles_comments.id',
            'articles_comments.article_id',
            'articles_comments.user_id',
            'articles_comments.parent_id',
            'articles_comments.body',
            'articles_comments.created_at',
            'users.name as user_name',
            'users.email as user_email'
        )
            ->where('articles_comments.article_id', $articleId)
            ->whereNull('articles_comments.parent_id')
            ->leftJoin('users', 'articles_comments.user_id', '=', 'users.id');

            if ($ordering->selected === 'userName'){
                $firstReplicas->orderBy('user_name', $ordering->userName);
            }

            if ($ordering->selected === 'email'){
                $firstReplicas->orderBy('user_email', $ordering->email);
            }

            $firstReplicas->orderBy('articles_comments.created_at', $ordering->createdAt);

            $firstReplicas = $firstReplicas->paginate(25);

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

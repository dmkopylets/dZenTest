<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\ArticlesComment;
use App\Http\Fetchers\ArticleCommentsFetcher;
use App\Models\Entities\ArticlesCommentEntity;

class ArticleCommentController extends \App\Http\Controllers\Controller
{
    protected Article $article;

    public function __construct(ArticlesComment $model, Request $request)
    {
        parent::__construct($request);
        $this->model = $model;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Article $article, Request $request)
    {
        $commentsFetcher = new ArticleCommentsFetcher();
        $comments = $commentsFetcher->getListArray($article->id);
        return view('article.comment.index', [
            'title' => 'Article # ' . $article->id . ' by ' . $article->user->name,
            'comments' => $comments,
            'article' => $article,
            'usersList' => $this->usersArray,
            'signedUser' => $this->getSignedUser(),
        ]);
    }

    public function addFirst(Article $article, Request $request)
    {
        $input['user_id'] = (int)$request->input('userDialer');
        $input['article_id'] = $article->id;
        $input['position'] = 1;
        $input['body'] = (string)$request->input('body');
        ArticlesComment::create($input);
        return redirect()->route('articles.comments', ['article' => $article]);
    }

    public function store(Article $article, ArticlesComment $comment, Request $request,)
    {
        $input['user_id'] = (int)$request->input('userDialer');
        $input['article_id'] = $article->id;
        $input['parent_id'] = request()->input('parent_id_' . (string)$comment->id);
        $input['body'] = (string)$request->input('body_' . (string)$comment->id );
        $input['position'] = $comment->position + 1;
        ArticlesComment::create($input);

        return redirect()->route('articles.comments', ['article' => $article]);
    }
}

<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\ArticlesComment;
use App\Http\Fetchers\ArticleCommentsFetcher;
use App\Http\Fetchers\OrderByDTO;

class ArticleCommentController extends \App\Http\Controllers\Controller
{
    protected Article $article;
    protected OrderByDTO $ordering;

    public function __construct(ArticlesComment $model, Request $request)
    {
        parent::__construct($request);
        $this->model = $model;
        $this->ordering = new OrderByDTO;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Article $article, Request $request)
    {
        $this->ordering->userName = 'asc';
        $commentsFetcher = new ArticleCommentsFetcher();
        $comments = $commentsFetcher->getCombinedReplicas( $article->id, $this->ordering );

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
        $input['body'] = (string)$request->input('articleCommentText');
        ArticlesComment::create($input);
        return redirect()->route('articles.comments', ['article' => $article]);
    }

    public function store(Article $article, ArticlesComment $comment, Request $request,)
    {
        $input['user_id'] = (int)$request->input('userDialer');
        $input['article_id'] = $article->id;
        $input['parent_id'] = request()->input('parent_id_' . (string)$comment->id);
        $input['body'] = (string)$request->input('replyText');
        $input['position'] = $comment->position++;
        ArticlesComment::create($input);

        return redirect()->route('articles.comments', ['article' => $article]);
    }
}

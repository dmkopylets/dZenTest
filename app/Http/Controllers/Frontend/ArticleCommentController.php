<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Fetchers\OrderByDTO;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\ArticlesComment;

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
    public function index(Article $article, OrderByDTO $orderingSets)
    {
        $this->ordering = $orderingSets;

        return view('article.comment.index', [
            'title' => 'Article # ' . $article->id . ' by ' . $article->user->name,
            'comments' => $this->commentsFetcher->getCombinedReplicas( $article->id, $this->ordering),
            'article' => $article,
            'usersList' => $this->usersArray,
            'signedUser' => $this->getSignedUser(),
            'orderingSets' => $this->ordering
        ]);
    }

    public function addFirst(Article $article, Request $request)
    {
        $input['user_id'] = (int)$request->input('userDialer');
        $input['article_id'] = $article->id;
        $input['position'] = 1;
        $input['body'] = (string)$request->input('articleCommentText');
        $this->model::create($input);
        return redirect()->route('articles.comments', ['article' => $article]);
    }

    public function store(Article $article, ArticlesComment $comment, Request $request,)
    {
        $input['user_id'] = (int)$request->input('userDialer');
        $input['article_id'] = $article->id;
        $input['parent_id'] = request()->input('parent_id_' . (string)$comment->id);
        $input['body'] = (string)$request->input('replyText');
        $input['position'] = $comment->position++;
        $this->model::create($input);
        return redirect()->route('articles.comments', ['article' => $article]);
    }

    public function reSortByDate(Article $article, Request $request)
    {
        $requestData = $request->all();
        $orderingSets = $requestData['orderingSets'];
        $this->ordering->userName = $orderingSets['userName'];
        $this->ordering->email = $orderingSets['email'];
        $this->ordering->createdAt = ($orderingSets['createdAt'] === 'desc') ? 'asc' : 'desc';
        $this->ordering->selected = $orderingSets['selected'];
        return $this->index($article, $this->ordering);
    }

    public function reSortByName(Article $article, Request $request)
    {
        $requestData = $request->all();
        $orderingSets = $requestData['orderingSets'];
        $this->ordering->userName = ($orderingSets['userName'] === 'desc') ? 'asc' : 'desc';
        $this->ordering->email = $orderingSets['email'];
        $this->ordering->createdAt = $orderingSets['createdAt'];
        $this->ordering->selected = 'userName';
        return $this->index($article, $this->ordering);
    }

    public function reSortByEmail(Article $article, Request $request)
    {
        $requestData = $request->all();
        $orderingSets = $requestData['orderingSets'];
        $this->ordering->userName = $orderingSets['userName'];
        $this->ordering->email = ($orderingSets['email'] === 'desc') ? 'asc' : 'desc';
        $this->ordering->createdAt = $orderingSets['createdAt'];
        $this->ordering->selected = 'email';
        return $this->index($article, $this->ordering);
    }
}

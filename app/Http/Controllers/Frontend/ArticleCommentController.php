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
        $this->orderingSets = $orderingSets;

        return view('article.comment.index', [
            'title' => 'Article # ' . $article->id . ' by ' . $article->user->name,
            'comments' => $this->commentsFetcher->getCombinedReplicas( $article->id, $this->orderingSets),
            'article' => $article,
            'usersList' => $this->usersArray,
            'signedUser' => $this->getSignedUser(),
            'orderingSets' => $this->orderingSets
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

    private function applyOrdering(Article $article, array $orderingSets)
    {
        $this->orderingSets->userName = $orderingSets['userName'];
        $this->orderingSets->email = $orderingSets['email'];
        $this->orderingSets->selected = $orderingSets['selected'];
        $this->orderingSets->createdAt = $orderingSets['createdAt'];
        return $this->index($article, $this->orderingSets);
    }

    public function reSortByDate(Article $article, Request $request)
    {
        $orderingSets = $request->input('orderingSets');
        $orderingSets['createdAt']  = ($orderingSets['createdAt'] === 'desc') ? 'asc' : 'desc';
        return $this->applyOrdering($article, $orderingSets);
    }

    public function reSortByName(Article $article, Request $request)
    {
        $orderingSets = $request->input('orderingSets');
        $orderingSets['userName'] = ($orderingSets['userName'] === 'desc') ? 'asc' : 'desc';
        $orderingSets['selected'] = 'userName';
        return $this->applyOrdering($article, $orderingSets);
    }

    public function reSortByEmail(Article $article, Request $request)
    {
        $orderingSets = $request->input('orderingSets');
        $orderingSets['email'] = ($orderingSets['email'] === 'desc') ? 'asc' : 'desc';
        $orderingSets['selected'] = 'email';
        return $this->applyOrdering($article, $orderingSets);
    }
}

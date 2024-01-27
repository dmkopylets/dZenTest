<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Fetchers\OrderByDTO;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\ArticlesComment;
use App\Http\Requests\CreateCommentRequest;

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

    public function addFirst(CreateCommentRequest $request)
    {
        $input = $request->validated();
        $input['position'] = 1;
        $url = route('articles.comments.store');
        app()->handle(Request::create($url, 'POST', ['data' => json_encode($input)]));
        return redirect()->route('articles.comments', ['article' => $input['article_id']]);
    }

    public function addReply(int $article_id, int $comment_id, CreateCommentRequest $request)
    {
        $input = $request->validated();
        $comment = $this->model->find($comment_id);
        $input['parent_id'] = $comment->id;
        $input['position'] = $comment->position + 1;
        $url = route('articles.comments.store');
        app()->handle(Request::create($url, 'POST', ['data' => json_encode($input)]));
        return redirect()->route('articles.comments', ['article' => $input['article_id']]);
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

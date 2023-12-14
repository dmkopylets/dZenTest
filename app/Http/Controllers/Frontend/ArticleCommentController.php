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
    public function index(Article $article)
    {
        //dd($this->signedUser);
                //$this->signedUser = $this->usersArray[(int)$request->input('userDialer')];
        $commentsFetcher = new ArticleCommentsFetcher();
        $comments = $commentsFetcher->getListArray($article->id);

        return view('article.comment.index', [
            'title' => 'Article # ' . $article->id . ' by ' . $article->user->name,
            'comments' => $comments,
            'article' => $article,
            'usersList' => $this->usersArray,
            'signedUser' => $this->signedUser,
        ]);
    }

    public function addFirst(Request $request)
    {
        $input['user_id'] = (int)$request->input('userDialer');
        $input['article_id'] = request()->article;
        $input['position'] = 1;
        $input['body'] = (string)$request->input('body');
        ArticlesComment::create($input);
        return back();
    }

    public function store(Request $request)
    {
        $input['user_id'] = (int)$request->input('userDialer');
        $input['article_id'] = request()->article;
        $input['parent_id'] = request()->input('parent_id');
        $input['body'] = (string)$request->input('body');

        $comment = ArticlesCommentEntity::find(request()->input('parent_id'));
        $input['position'] = $comment->position + 1;


        // $newChildComment = new ArticlesCommentEntity($input);
        // $comment->addChild($newChildComment);
        ArticlesComment::create($input);
        //dd($comment);
        return back();
    }
}

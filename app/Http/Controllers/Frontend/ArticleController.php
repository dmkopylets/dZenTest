<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\ArticleCommentController;
use App\Models\ArticlesComment;

class ArticleController extends Controller
{
    private ArticleCommentController $comments;

    public function __construct(Article $model)
    {
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('article.index', [
            'records' => $this->model->getList(),
            'add_th' => array('Title'),
            'add_td' => array( 'title'),
            'th_width' => array(350)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Article $article)
    {
        return route('articles.comments.index', ['article' => $article]);
    }
}

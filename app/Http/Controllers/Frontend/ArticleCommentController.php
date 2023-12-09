<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\ArticlesComment;

class ArticleCommentController extends \App\Http\Controllers\Controller
{
    protected Article $article;

    // public function __construct(ArticlesComment $model)
    // {
    //     $this->model = $model;
    // }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('article.comment.index', [
          //  'records' => $this->model->getList(),
            'add_th' => array('user_name', 'body'),
            'add_td' => array('user_name', 'body'),
            'th_width' => array(160, 350),
            'article' => $this->article,
        ]);
    }

    public function customMethod(Article $article)
    {
        $this->article = $article;

       // dd($article->user->name);

        return view('article.comment.index', [
            // 'records' => $this->model->getList(),
            // 'add_th' => array('user_name', 'body'),
            // 'add_td' => array('user_name', 'body'),
            // 'th_width' => array(160, 350),
            'article' => $article,
        ]);// Ваш код обробки тут, $article буде передано автоматично з маршруту
    }

}

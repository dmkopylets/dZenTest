<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\ArticleCommentController;

class ArticleController extends Controller
{
    private ArticleCommentController $comments;

    public function __construct(Article $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('article.index', [
            'title' => 'Articals list',
            'records' => $this->model->getList(),
            'add_th' => array('Title'),
            'add_td' => array( 'title'),
            'th_width' => array(350),
            'usersList' => $this->usersArray,
            'signedUser' => $this->signedUser,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Article $article,)
    {
        dd($request->input('email'));
        return route('articles.comments', ['article' => $article, $signedUser = []]);
    }
}

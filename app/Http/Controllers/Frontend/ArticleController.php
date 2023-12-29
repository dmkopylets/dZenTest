<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Frontend\ArticleCommentController;

class ArticleController extends Controller
{
    private ArticleCommentController $comments;

    public function __construct(Article $model, Request $request)
    {
        parent::__construct($request);
        $this->model = $model;
    }

    /**
     * Display a listing of the resource.
     */
    public function index( Request $request )
    {
        $wantedAuthor = __($request->input('wantedAuthor'));
        $wantedTitle = __($request->input('wantedTitle'));

        return view('article.index', [
            'title' => 'Articals list',
            'records' => $this->model->getList($wantedAuthor, $wantedTitle),
            'add_th' => array('Author', 'Title'),
            'add_td' => array('user_name', 'title'),
            'th_width' => array(200, 400),
            'usersList' => $this->usersArray,
            'orderingSets' => $this->orderingSets,
        ]);
    }
}

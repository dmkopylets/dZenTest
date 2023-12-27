<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Fetchers\OrderByDTO;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\ArticlesComment;
use OpenApi\Annotations as OA;

class ArticleCommentController extends ApiController
{
    protected Article $article;

    public function __construct(ArticlesComment $model, Request $request)
    {
        parent::__construct($request);
        $this->model = $model;
    }
    /**
     * @OA\Get(
     *     path="/api/v1/articles/{article}/comments",
     *     summary="list of comments to the article",
     *     operationId="getCommentsList",
     *     tags={"comments"},
     *     @OA\Parameter(
     *         name="article",
     *         description="Articles id to show list",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer",
     *         )
     *      ),
     *     @OA\Response(
     *          response=404,
     *          description="comments not found",
     *       ),
     *     @OA\Response(
     *          response="default",
     *          response=200,
     *          description="OK",
     *          @OA\MediaType(
     *              mediaType="application/json"
     *           )
     *       )
     *  )
     */
    public function index(int $articleId, OrderByDTO $orderingSets)
    {
        $this->orderingSets = $orderingSets;
        return response()->json($this->commentsFetcher->getCombinedReplicas($articleId, $orderingSets), 200, [], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }

    public function addFirst(int $articleId, Request $request)
    {
        $input['user_id'] = (int)$request->input('userDialer');
        $input['article_id'] = $articleId;
        $input['position'] = 1;
        $input['body'] = (string)$request->input('articleCommentText');
        $this->model::create($input);
        // return redirect()->route('api.v1.articles.comments', ['article' => $article]);
    }

    public function store(Article $article, ArticlesComment $comment, Request $request)
    {
        // $input['user_id'] = (int)$request->input('userDialer');
        // $input['article_id'] = $article->id;
        // $input['parent_id'] = request()->input('parent_id_' . (string)$comment->id);
        // $input['body'] = (string)$request->input('replyText');
        // $input['position'] = $comment->position++;
        // $this->model::create($input);
        // return redirect()->route('articles.comments', ['article' => $article]);
    }

    private function applyOrdering(int $articleId, array $orderingSets)
    {
        $this->orderingSets->userName = $orderingSets['userName'];
        $this->orderingSets->email = $orderingSets['email'];
        $this->orderingSets->selected = $orderingSets['selected'];
        $this->orderingSets->createdAt = $orderingSets['createdAt'];
        return $this->index($articleId, $this->orderingSets);
    }
    public function reSortByDate(int $articleId, Request $request)
    {
        $orderingSets = $request->input('orderingSets');
        $orderingSets['createdAt'] = ($orderingSets['createdAt'] === 'desc') ? 'asc' : 'desc';
        return $this->applyOrdering($articleId, $orderingSets);
    }

    public function reSortByName(int $articleId, Request $request)
    {
        $orderingSets = $request->input('orderingSets');
        $orderingSets['userName'] = ($orderingSets['userName'] === 'desc') ? 'asc' : 'desc';
        $orderingSets['selected'] = 'userName';
        return $this->applyOrdering($articleId, $orderingSets);
    }

    public function reSortByEmail(int $articleId, Request $request)
    {
        $orderingSets = $request->input('orderingSets');
        $orderingSets['email'] = ($orderingSets['email'] === 'desc') ? 'asc' : 'desc';
        $orderingSets['selected'] = 'email';
        return $this->applyOrdering($articleId, $orderingSets);
    }
}

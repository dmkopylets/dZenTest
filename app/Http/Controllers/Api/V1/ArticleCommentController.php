<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\ApiController;
use App\Http\Fetchers\OrderByDTO;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Models\ArticlesComment;
use OpenApi\Annotations as OA;
use App\Http\Requests\CreateCommentRequest;

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
     *     summary="List of comments to the article",
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

    /**
     * @OA\Post(
     *     path="/api/v1/articles/{article_id}/comments/add-first",
     *     summary="add firstLevel comment to the article",
     *     operationId="addFirstComment",
     *     tags={"comments"},
     *     @OA\Parameter(
     *         name="article_id",
     *         description="Articles id to comment",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer",
     *         )
     *      ),
     *     @OA\Parameter(
     *         name="user_id",
     *         description="Users id to comment",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="integer",
     *         )
     *      ),
     *     @OA\Parameter(
     *         name="body",
     *         description="Text comment",
     *         in="query",
     *         @OA\Schema(
     *             type="text",
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
    public function addFirst(CreateCommentRequest $request)
    {
        $data = $request->validated();
        $data['position'] = 1;
        //$this->model->fill($data)->push();
        return $this->sendResponse(null, 'Created', 201);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/articles/{article_id}/comments/add-reply",
     *     summary="add comment to comment",
     *     operationId="addReply",
     *     tags={"comments"},
     *     @OA\Parameter(
     *         name="article_id",
     *         description="Articles id to comment",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer",
     *         )
     *      ),
     *     @OA\Parameter(
     *         name="user_id",
     *         description="Users id to comment",
     *         required=true,
     *         in="query",
     *         @OA\Schema(
     *             type="integer",
     *         )
     *      ),
     *     @OA\Parameter(
     *         name="parent_id",
     *         description="id parent's comment",
     *         required=true,
     *         in="path",
     *         @OA\Schema(
     *             type="integer",
     *         )
     *      ),
     *     @OA\Parameter(
     *         name="body",
     *         description="Text comment",
     *         in="query",
     *         @OA\Schema(
     *             type="text",
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
    public function addReply(Article $article, ArticlesComment $comment, Request $request)
    {
        $data = $request->validated();
        $data['position'] = $comment->position++;
        $input['parent_id'] = $comment->id;
        //$this->model->fill($data)->push();
        return $this->sendResponse(null, 'Created', 201);
    }

    /**
     * @OA\Post(
     *     path="/api/v1/articles/comments/store",
     *     summary="main action",
     *     operationId="saveComment",
     *     tags={"comments"},
     *     @OA\RequestBody(
     *         description="Client side request to store comment",
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="data",
     *                     type="object",
     *                     @OA\Property(property="user_id", type="integer"),
     *                     @OA\Property(property="article_id", type="integer"),
     *                     @OA\Property(property="body", type="string"),
     *                     @OA\Property(property="parent_id", type="integer"),
     *                     @OA\Property(property="position", type="integer"),
     *                 ),
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent()
     *     )
     * )
     */
    public function store(Request $request)
    {
        $data = json_decode($request->input('data'), true);
        $this->model->fill($data)->push();
        return $this->sendResponse(null, 'Created', 201);
    }
    /**
     * @OA\Get(
     *     path="/api/v1/articles/{article}/comments/reSortByDate",
     *     summary="Sort the list of article comments by the date of creation",
     *     operationId="getCommentsListSortedByDate",
     *     tags={"comments"},
     *     @OA\Parameter(
     *          name="article",
     *          description="Articles id to show list",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="direction",
     *          description="Direction for sorting the list",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string",
     *              enum={"asc", "desc"}
     *          )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="{ }")
     * )
     */
    public function reSortByDate(int $articleId, OrderByDTO $orderingSets, Request $request)
    {
        $orderingSets->createdAt = $request->input('direction', 'desc');
        return $this->index($articleId, $orderingSets);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/articles/{article}/comments/reSortByName",
     *     summary="Sort the list of article comments by user name",
     *     operationId="getCommentsListSortedByName",
     *     tags={"comments"},
     *     @OA\Parameter(
     *          name="article",
     *          description="Articles id to show list",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="direction",
     *          description="Direction for sorting the list",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string",
     *              enum={"asc", "desc"}
     *          )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="{ }")
     * )
     */
    public function reSortByName(int $articleId, OrderByDTO $orderingSets, Request $request)
    {
        $orderingSets->selected = 'userName';
        $orderingSets->userName = $request->input('direction', 'asc');
        return $this->index($articleId, $orderingSets);
    }

    /**
     * @OA\Get(
     *     path="/api/v1/articles/{article}/comments/reSortByEmail",
     *     summary="Sort the list of article comments by user email",
     *     operationId="getCommentsListSortedByEmail",
     *     tags={"comments"},
     *     @OA\Parameter(
     *          name="article",
     *          description="Articles id to show list",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer",
     *          )
     *      ),
     *     @OA\Parameter(
     *          name="direction",
     *          description="Direction for sorting the list",
     *          required=true,
     *          in="query",
     *          @OA\Schema(
     *              type="string",
     *              enum={"asc", "desc"}
     *          )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="{ }")
     * )
     */
    public function reSortByEmail(int $articleId, OrderByDTO $orderingSets, Request $request)
    {
        $orderingSets->email =  $request->input('direction', 'asc');
        $orderingSets->selected = 'email';
        return $this->index($articleId, $orderingSets);
    }
}

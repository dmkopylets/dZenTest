<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use OpenApi\Annotations as OA;

class ArticleController extends ApiController
{
    public function __construct(Article $model, Request $request)
    {
        parent::__construct($request);
        $this->model = $model;
    }

    /**
     * @OA\Get(
     *     path="/api/v1/articles",
     *     summary="Articles listing",
     *     operationId="getArticlesList",
     *     tags={"articles"},
     *     @OA\Response(
     *          response=404,
     *          description="articles not found",
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
    public function index()
    {
        return response()->json($this->model->getList(), 200, [], JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
    }
}

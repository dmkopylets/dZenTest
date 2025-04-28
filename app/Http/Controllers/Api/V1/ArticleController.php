<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\V1\ApiController;
use OpenApi\Annotations as OA;
use Illuminate\Http\JsonResponse;

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
     *     @OA\Parameter(
     *         description="part of the user name",
     *         name="wantedAuthor",
     *         in="query",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="part of the article's title",
     *         name="wantedTitle",
     *         in="query",
     *         @OA\Schema(
     *             type="string",
     *         )
     *     ),
     *     @OA\Response(
     *          response="default",
     *          response=200,
     *          description="OK",
     *          @OA\MediaType(
     *              mediaType="application/json"
     *           )
     *       ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *     @OA\Response(
     *          response=404,
     *          description="articles not found",
     *       )
     *  )
     */
    public function index( Request $request ) //: JsonResponse
    {
        $wantedAuthor = __($request->input('wantedAuthor'));
        $wantedTitle = __($request->input('wantedTitle'));
        $articles = $this->model->getList($wantedAuthor, $wantedTitle);

        if (count($articles) < 1 ) {
            return $this->sendError('no such articles were found', 404, []);
        }
        return $this->sendResponse($articles, 'Ok', 200);
    }
}

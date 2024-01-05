<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Database\Eloquent\Model;
use OpenApi\Annotations as OA;

abstract class ApiController extends Controller
{
    use ApiResponse;

    /**
     * @OA\Info(
     *     title="Laravel Swagger API documentation for test task",
     *     version="1.0.0",
     *     @OA\Contact(
     *         name="Dmytro",
     *         email="dm.kopylets@gmail.com"
     *         )
     * )
     *
     */

    protected Model $model;
}

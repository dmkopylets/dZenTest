<?php

use Illuminate\Support\Facades\Route;

{
    Route::get('articles', [App\Http\Controllers\Api\V1\ArticleController::class, 'index']);
    Route::get('articles/{article}/comments/',[App\Http\Controllers\Api\V1\ArticleCommentController::class, 'index'])->name('articles.comments');
}

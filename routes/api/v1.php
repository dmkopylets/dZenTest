<?php

use Illuminate\Support\Facades\Route;

{
    Route::get('articles', [App\Http\Controllers\Api\V1\ArticleController::class, 'index']);
    Route::get('articles/{article}/comments/',[App\Http\Controllers\Api\V1\ArticleCommentController::class, 'index'])->name('articles.comments');
    Route::get('articles/{article}/comments/reSortByDate',[App\Http\Controllers\Api\V1\ArticleCommentController::class, 'reSortByDate'])->name('articles.comments.reSortByDate');
    Route::get('articles/{article}/comments/reSortByName',[App\Http\Controllers\Api\V1\ArticleCommentController::class, 'reSortByName'])->name('articles.comments.reSortByName');
    Route::get('articles/{article}/comments/reSortByEmail',[App\Http\Controllers\Api\V1\ArticleCommentController::class, 'reSortByEmail'])->name('articles.comments.reSortByEmail');
    Route::post('articles/{article_id}/comments/add-first', [App\Http\Controllers\Api\V1\ArticleCommentController::class, 'addFirst'])->name('articles.comments.first');
}

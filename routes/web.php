<?php

use Illuminate\Support\Facades\Route;

Route::resource('/', App\Http\Controllers\Frontend\ArticleController::class)->except(['create', 'edit', 'store', 'update', 'destroy']);
Route::get('articles/{article}', [App\Http\Controllers\Frontend\ArticleController::class, 'show']);
//Route::resource('articles.comments', App\Http\Controllers\Frontend\ArticleCommentController::class)->shallow();
Route::get('articles/{article}/comments', [App\Http\Controllers\Frontend\ArticleCommentController::class, 'customMethod'])->name('articles.comments.custom');


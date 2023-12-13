<?php

use Illuminate\Support\Facades\Route;

Route::resource('/', App\Http\Controllers\Frontend\ArticleController::class)->except(['create', 'edit', 'store', 'update', 'destroy']);
Route::get('articles/{article}', [App\Http\Controllers\Frontend\ArticleController::class, 'show']);
Route::get('articles/{article}/show', [App\Http\Controllers\Frontend\ArticleController::class, 'show'])->name('articles.show');
Route::get('articles/{article}/comments', [App\Http\Controllers\Frontend\ArticleCommentController::class, 'index'])->name('articles.comments.index');
Route::post('articles/{article}/add-first/{comment}', [App\Http\Controllers\Frontend\ArticleCommentController::class, 'addFirst'])->name('articles.comments.first');
Route::post('articles/{article}/store/{comment}', [App\Http\Controllers\Frontend\ArticleCommentController::class, 'store'])->name('articles.comments.store');

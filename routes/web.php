<?php

use Illuminate\Support\Facades\Route;

Route::resource('/', App\Http\Controllers\Frontend\ArticleController::class)->except(['create', 'edit', 'store', 'update', 'destroy']);
Route::get('articles/{article}/comments/',[App\Http\Controllers\Frontend\ArticleCommentController::class, 'index'])->name('articles.comments');
Route::post('articles/{article}/comments/',[App\Http\Controllers\Frontend\ArticleCommentController::class, 'index'])->name('articles.comments');
Route::post('articles/{article_id}/comments/add-first', [App\Http\Controllers\Frontend\ArticleCommentController::class, 'addFirst'])->name('articles.comments.first');
Route::post('articles/{article_id}/comments/add-reply', [App\Http\Controllers\Frontend\ArticleCommentController::class, 'addReply'])->name('articles.comments.reply');
Route::get('articles/{article}/comments/reSortByDate',[App\Http\Controllers\Frontend\ArticleCommentController::class, 'reSortByDate'])->name('articles.comments.reSortByDate');
Route::get('articles/{article}/comments/reSortByName',[App\Http\Controllers\Frontend\ArticleCommentController::class, 'reSortByName'])->name('articles.comments.reSortByName');
Route::get('articles/{article}/comments/reSortByEmail',[App\Http\Controllers\Frontend\ArticleCommentController::class, 'reSortByEmail'])->name('articles.comments.reSortByEmail');

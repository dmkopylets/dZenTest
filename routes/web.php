<?php

use Illuminate\Support\Facades\Route;

Route::resource('/', App\Http\Controllers\Frontend\ArticleController::class)->except(['create', 'edit', 'store', 'update', 'destroy']);
Route::get('articles/{article}/comments/',[App\Http\Controllers\Frontend\ArticleCommentController::class, 'index'])->name('articles.comments');
Route::post('articles/{article}/comments/',[App\Http\Controllers\Frontend\ArticleCommentController::class, 'index'])->name('articles.comments');
Route::post('articles/{article}/add-first', [App\Http\Controllers\Frontend\ArticleCommentController::class, 'addFirst'])->name('articles.comments.first');
Route::post('articles/{article}/comments/{comment}/store', [App\Http\Controllers\Frontend\ArticleCommentController::class, 'store'])->name('articles.comments.store');

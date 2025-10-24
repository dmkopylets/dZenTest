<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function show(Post $post, Request $request)
    {
        $user = $request->user();
        $post = Post::query()
            ->where('id', '=', 1)
            ->limit(1)
            ->first();
        return view('post.view', compact('post', 'user'));
    }
}

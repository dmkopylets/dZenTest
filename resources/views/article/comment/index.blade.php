@extends('layouts.app')
@section('content')

<div class="container">
    @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <h2>Article owner <strong>{{$article->user->name}}</strong></h2>

    <textarea readonly class="form-control" name="article_text" rows="4"> {{$article->body}} </textarea>
    <input type="hidden" name="article_id" value="{{ $article->id }}" />

    <hr />
    @if ( count($comments) > 0 )
    <h2>There are comments for this article:</h2>
    @include('article.comment.commentsDisplay', ['comments' => $comments, 'article_id' => $article->id])
    @else
    <h2>There are no comments for this article</h2>
    @endif
    <hr />
    <br>



        <span class="text-muted"><i>New comment for this article</i></span>
        <textarea class="form-control" name="body" rows="4"></textarea>

        <div class="row">
            <div class="input-group flex-nowrap">
                <div class="input-group-prepend">
                    <button class="btn btn-warning btn-block" formaction="{{ route('articles.comments.first', ['article' => $article, 'comment => $comment']) }}" type="submit" method="POST">Comment article</button>
                </div>
            </div>
        </div>

</div>

@endsection

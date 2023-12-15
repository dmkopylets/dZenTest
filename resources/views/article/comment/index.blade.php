@extends('layouts.app')
<form>
@csrf
@method('post')
@include('layouts.nav')
@section('content')

<div class="container">
    @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <h3>Article owner <strong>{{$article->user->name}}</strong></h3>

    <textarea readonly class="form-control" name="article_text" rows="4"> {{$article->body}} </textarea>
    <input type="hidden" name="article_id" value="{{ $article->id }}" />

    <hr />
        @if ( count($comments) > 0 )
            <h3>There are comments for this article:</h3>
            @include('article.comment.commentsDisplay', ['comments' => $comments, 'article_id' => $article->id])
        @else
            <h3>There are no comments for this article</h3>
        @endif
    <hr />
    <br>

        <span class="text-muted"><i>New comment for this <strong>article</strong></i></span>

        <div class="row" style="margin-top:5pt; margin-left:2pt; margin-right:2pt;">
        <textarea class="form-control" name="articleCommentText" rows="3"></textarea>
            <div style="float: right; margin-right: 10px;">
                    <button
                    class="btn btn-warning btn-block"
                    type="submit"
                    formmethod="post"
                    style="float: right;"
                    formaction="{{ route('articles.comments.first', ['article' => $article]) }}"
                    >Comment article</button>
            </div>
        </div>

        <div class="row" style="margin-top:5pt; margin-left:2pt; margin-right:2pt;">
        <span class="text-muted"><i>text <strong>reply</strong></i></span>
            <textarea class="form-control" name="replyText" rows="2"></textarea>
        </div>

</div>
</form>
@endsection

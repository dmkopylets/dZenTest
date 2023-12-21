@extends('layouts.app')
@section('content')
<form method="post">
@csrf
@method('post')
@include('layouts.nav')
<div class="container">
    @if (Session::has('message'))
    <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif

    <h3>Article owner <strong>{{$article->user->name}}</strong></h3>

    <textarea readonly class="form-control" name="article_text" rows="4"> {{$article->body}} </textarea>
    <input type="hidden" name="article_id" value="{{ $article->id }}" />
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

    <hr />
        @if ( count($comments) > 0 )
            <h3>There are comments for this article:</h3>
            <table width="700">
                <tr>
                    <th width="5%"></th>
                    <th width="25%">
                    <div class="form-check form-switch p-0">
                        <div class="d-inline-flex flex-row-reverse gap-1">
                            <input class="form-check-input ms-0" type="checkbox" id="switchChecOrderByUserName" onclick="switchedChecOrderByUserName()">
                            <label class="form-check-label" for="switchChecOrderByUserName">User name</label>
                            <i class="fa fa-sort"></i>
                        </div>
                    </div>
                    </th>
                    <th width="40%">
                    <div class="form-check form-switch p-0">
                        <div class="d-inline-flex flex-row-reverse gap-1">
                            <input class="form-check-input ms-0" type="checkbox" id="switchChecOrderByEmail" onclick="switchedChecOrderByEmail()">
                            <label class="form-check-label" for="switchChecOrderByEmail">email</label>
                            <i class="fa fa-sort"></i>
                        </div>
                    </div>
                    </th>
                    <th width="30%">
                    <div class="form-check form-switch p-0">
                        <div class="d-inline-flex flex-row-reverse gap-1">
                            <input class="form-check-input ms-0" type="checkbox" id="switchChecOrderByCreatedAt" onclick="switchedChecOrderByCreatedAt()">
                            <label class="form-check-label" for="switchChecOrderByCreatedAt">created</label>
                            <i class="fa fa-sort"></i>
                        </div>
                    </div>
                    </th>
                </tr>
            </table>
            @include('article.comment.commentsDisplay', ['comments' => $comments, 'article_id' => $article->id])
        @else
            <h3>There are no comments for this article</h3>
        @endif
</div>
</form>
@endsection

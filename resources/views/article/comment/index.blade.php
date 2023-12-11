@extends('layouts.app')
@section('content')

<div class="container">
    @if (Session::has('message'))
        <div class="alert alert-info">{{ Session::get('message') }}</div>
    @endif



    <h2>Article owner <strong>{{$article->user->name}}</strong></h2>
    <div class="col-md-6 col-lg-9">
            <textarea readonly class="form-control"  name="article_text" rows="4"> {{$article->body}} </textarea>
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


    <form method="post">
    @csrf

                    <span class="text-muted"><i>New comment for this article</i></span>
                    <textarea class="form-control" name="body" rows="4"></textarea>

        <div class="row">
        <div class="col-md-6 col-lg-9">


            <div class="input-group flex-nowrap">
            <div >
                <i style="font-size: 10pt; margin-top:5pt; margin-right:10pt;">select a commenter: </i>
            </div>
                <div class="input-group-prepend">
                    <select class="form-control userDialer" id="userDialer" name="userDialer" required>
                        @foreach($usersList as $user)
                            <option value="{{$user['id']}}">{{$user['name']}}</option>
                        @endforeach
                    </select>
                </div>
                &nbsp
                &nbsp
                <div class="input-group-prepend">
                    <button
                    class="btn btn-outline-warning btn-block"
                    formaction="{{ route('articles.comments.first', ['article' => $article, 'comment => $comment']) }}"
                    type="submit"
                    method = "POST"
                    >Comment article</button>
                </div>
            </div>
        </div>
    </div>




              <tbody>

            </tbody>
         </table>
     </form>
    </div>
    </div>

@endsection

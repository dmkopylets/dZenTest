<table class="table  table-striped" id="dict-table">
    @foreach($comments as $comment)
    <tr>
        <td><strong>{{ $comment->user->name }}</strong> {{ $comment->created_at }}
                <p>{{ $comment->body }}</p>
            </td>
    </tr>
    <tr>
        <td>
            <form method="post" action="{{ route('articles.comments.store', ['article' => $article, 'comment => $comment']) }}">
                @csrf
                <div class="form-group">
                    <input type="text" name="body" class="form-control" />
                    <input type="hidden" name="article_id" value="{{ $article_id }}" />
                    <input type="hidden" name="parent_id" value="{{ $comment->id }}" />
                </div>

                <div class="input-group flex-nowrap  ml-auto"  style="float: right;">
                    <div>
                        <i style="font-size: 10pt; margin-top:5pt; margin-right:10pt;">select a commenter: </i>
                    </div>


                        <select class="form-control replicator" name="replicator" required>
                            @foreach($usersList as $user)
                            <option value="{{$user['id']}}">{{$user['name']}}</option>
                            @endforeach
                        </select>

                    <div class="form-group">
                        <input type="submit" class="btn btn-warning" value="Reply" />
                    </div>
                </div>
            </form>
        </td>
        </div>
    </tr>
    @endforeach
</table>

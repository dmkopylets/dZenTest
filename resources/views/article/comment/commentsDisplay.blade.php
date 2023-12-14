<table class="table  table-striped" id="dict-table">
    @foreach($comments as $comment)
    <tr>
        <td><strong>{{ $comment->user->name }}</strong> {{ $comment->created_at }}
            <p>@for ($i = 0; $i < $comment->position; $i++) {{"---"}}@endfor{{ $comment->body }}</p>
        </td>
    </tr>
    <tr>
        <td>
                <div class="form-group">
                    <input type="text" name="body_{{ $comment->id }}" class="form-control" />
                    <input type="text" name="parent_id_{{ $comment->id }}" value="{{ $comment->id }}" />
                    <input type="text" name="position_{{ $comment->position }}" value="{{ $comment->position }}" />
                </div>

                <div class="row" style="margin-top:5pt; margin-left:2pt; margin-right:2pt; float: right;">
                    <div style="float: right; margin-right: 10px;">
                    <button
                        class="btn btn-warning btn-block"
                        type="submit"
                        formmethod="post"
                        style="float: right;"
                        formaction="{{ route('articles.comments.store', ['article' => $article, 'comment' => $comment]) }}"
                    >Reply</button>
                    </div>
                </div>
        </td>
        </div>
    </tr>
    @endforeach
</table>

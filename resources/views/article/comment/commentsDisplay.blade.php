<table class="table  table-striped" id="dict-table">
    @foreach($comments as $comment)
    <tr>
        <td>
            <strong>{{ $comment->user->name }}</strong> {{ $comment->created_at }}
            <input type="hidden" name="parent_id_{{ $comment->id }}" value="{{ $comment->id }}" />
            <input type="hidden" name="position_{{ $comment->position }}" value="{{ $comment->position }}" />
        </td>
        <td>
            <div class="row" style="margin-top:5pt; margin-left:2pt; margin-right:2pt; float: right;">
                <div style="float: right; margin-right: 10px;">
                    <button class="btn btn-warning btn-block" type="submit" formmethod="post" style="float: right;" formaction="{{ route('articles.comments.store', ['article' => $article, 'comment' => $comment]) }}">Reply</button>
                </div>
            </div>
        </td>
    </tr>
    @foreach($comment->replicas as $replica)
    <tr>
        <td>
            <strong>{{ $replica->user->name }}</strong> {{ $replica->created_at }}
            <p>@for ($i = 0; $i < $replica->position; $i++) {{"---"}}@endfor{{ $replica->body }}</p>
            <input type="hidden" name="parent_id_{{ $replica->id }}" value="{{ $replica->id }}" />
            <input type="hidden" name="position_{{ $replica->position }}" value="{{ $replica->position }}" />
        </td>
        <td>
            <div class="row" style="margin-top:5pt; margin-left:2pt; margin-right:2pt; float: right;">
                <div style="float: right; margin-right: 10px;">
                    <button class="btn btn-warning btn-block" type="submit" formmethod="post" style="float: right;" formaction="{{ route('articles.comments.store', ['article' => $article, 'comment' => $comment]) }}">Reply</button>
                </div>
            </div>
        </td>
    </tr>
    @endforeach



    @endforeach
</table>

<div class="accordion" id="accordionPanelsStayOpen">
    @foreach($comments as $comment)
    <div class="accordion-item">
        <h2 class="accordion-header" id="panelsStayOpen-heading-{{ $comment->id }}">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapse-{{ $comment->id }}" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
                <table width="700">
                    <tr>

                        <td width="25%">
                            <strong>{{ __($comment->user_name) }} </strong>
                        </td>
                        <td width="30%">
                            {{ __($comment->user_email) }}
                        </td>
                        <td width="30%">
                            <code>{{ $comment->created_at }}</code>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            {{ __($comment->body) }}
                        </td>
                        <td>
                            <!--input type="hidden" name="parent_id_{{ $comment->id }}" value="{{ $comment->id }}" />
                            <input type="hidden" name="position_{{ $comment->position }}" value="{{ $comment->position }}" /-->
                            <div class="row" style="margin-top:5pt; margin-left:2pt; margin-right:2pt; float: right;">
                                <div style="float: right; margin-right: 10px;">
                                    <button class="btn btn-warning btn-block"
                                            type="submit"
                                            formmethod="post"
                                            style="float: right;"
                                            formaction="{{ route('articles.comments.reply',
                                                ['article_id' => $article,
                                                'comment_id' => $comment->id]) }}">Reply</button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>
            </button>
        </h2>
        <div id="panelsStayOpen-collapse-{{ $comment->id }}" class="accordion-collapse collapse show" aria-labelledby="panelsStayOpen-heading-{{ $comment->id }}">
            <div class="accordion-body">
                @foreach($comment->replicas as $replica)
                <table class="table table-striped" <tr>
                    <td>
                        <strong>{{ __($replica->user->name) }}</strong> {{ $replica->created_at }}
                        <p>@for ($i = 0; $i < $replica->position; $i++) {{"---"}}@endfor {{ __($replica->body) }}</p>
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
                </table>
                @endforeach
            </div>
        </div>
    </div>
    @endforeach
    <hr />
    <div class="paginator">
        {!! $comments->appends(\Request::except('page'))->render() !!}
        <p>{{ __('Page') }} {{ $comments->currentPage() }} {{ __('of') }} {{ $comments->lastPage() }}</p>
        {{ $comments->links() }}
    </div>
</div>

<article>
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
</article>

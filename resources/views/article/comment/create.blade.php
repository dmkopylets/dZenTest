<div>
    <form>
        <div>
            <input type="text" name="comment-body" placeholder="Leave a comment">
        </div>
        <button type="submit" class="btn btn-primary btn-lg btn-block" formaction="{{url('articles/' . $article->id . '/add')}}" method="POST">
            Comment
        </button>
        <button type="button" class="btn btn-warning btn-lg btn-block" formaction="#" method="POST">
            Cancel
        </button>
    </form>
</div>

<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;

class Comments extends Component
{
    public Post $post;

    protected $listeners = [
        'commentCreated' => '$refresh',
        'commentDeleted' => '$refresh',
    ];

    public function mount(Post $post)
    {
        $this->post = $post;
    }

    public function render()
    {
        $comments = $this->selectComments();
        return view('livewire.comments', compact('comments'));
    }

    /**
     *
     * @return mixed
     */
    private function selectComments()
    {
        return Comment::where('post_id', '=', $this->post->id)
            ->with(['post', 'user', 'comments'])
//            ->whereNull('parent_id')
            ->orderByDesc('created_at')
            ->get();
    }

    public function commentCreated()
    {
        $comments = $this->selectComments();
        $this->comments = $this->comments->prepend($comment);
    }

    public function commentDeleted(int $id)
    {
        $this->comments = $this->comments->reject(function ($comment) use ($id) {
            return $comment->id === $id;
        });
    }
}

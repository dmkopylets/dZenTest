<?php

namespace App\Livewire;

use App\Models\Post;
use App\Models\Comment;
use Livewire\Component;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\View;

class Comments extends Component
{
    public Post $post;

    protected $listeners = [
        'commentCreated' => '$refresh',
        'commentDeleted' => '$refresh',
    ];

    public function mount(Post $post): void
    {
        $this->post = $post;
    }

    public function render(): View
    {
        $comments = $this->selectComments();
        return view('livewire.comments', compact('comments'));
    }

    private function selectComments(): Builder|Collection
    {
        return Comment::where('post_id', '=', $this->post->id)
            ->with(['post', 'user', 'comments'])
            ->whereNull('parent_id')
            ->orderByDesc('created_at')
            ->get();
    }
}

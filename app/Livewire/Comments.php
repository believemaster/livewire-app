<?php

namespace App\Livewire;

use App\Models\Comment;
use Carbon\Carbon;
use Livewire\Component;

class Comments extends Component
{
    public $comments;
    public $newComment;

    public function mount()
    {
        $initialcomment = Comment::orderByDesc('created_at')->get();
        $this->comments = $initialcomment;
    }

    public function addComment()
    {
        if ($this->newComment == "") {
            return;
        }
        array_unshift($this->comments, [
            'body' => $this->newComment,
            'created_at' => Carbon::now()->diffForHumans(),
            'creator' => 'User'
        ]);

        $this->newComment = "";
    }
    public function render()
    {
        return view('livewire.comments');
    }
}

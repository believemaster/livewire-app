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
        $initialcomment = Comment::latest()->get();
        $this->comments = $initialcomment;
    }

    public function addComment()
    {
        if ($this->newComment == "") {
            return;
        }

        $createdComment = Comment::create(['body'=>$this->newComment, 'user_id' => 1]);
        $this->comments->prepend($createdComment);
        $this->newComment = "";
    }
    public function render()
    {
        return view('livewire.comments');
    }
}

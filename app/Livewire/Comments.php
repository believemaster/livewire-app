<?php

namespace App\Livewire;

use App\Models\Comment;
use Carbon\Carbon;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;

class Comments extends Component
{
    use WithPagination;
    public $newComment;
    public $image;


    #[On('fileUpload')]
    public function handleFileUpload($imageData)
    {
        // dd($imageData);
        $this->image = $imageData;
    }

    public function updated($newComment)
    {
        $this->validateOnly($newComment, ['newComment' => 'required|max:255']);
    }

    public function addComment()
    {
        $this->validate(['newComment' => 'required|max:255']);

        $createdComment = Comment::create(['body' => $this->newComment, 'user_id' => 1]);
        $this->newComment = "";

        session()->flash('message', 'Comment added successfully 😃');
    }

    public function remove($commentId)
    {
        $comment = Comment::find($commentId);

        $comment->delete();

        session()->flash('message', 'Comment removed successfully 😃');
    }
    public function render()
    {
        return view('livewire.comments', [
            'comments' => Comment::orderByDesc('created_at')->simplePaginate(3)
        ]);
    }
}

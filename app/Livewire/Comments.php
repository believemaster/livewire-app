<?php

namespace App\Livewire;

use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as ImageManagerStatic;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Str;

class Comments extends Component
{
    use WithPagination;
    public $newComment;
    public $image;
    public $ticketId;


    #[On('fileUpload')]
    public function handleFileUpload($imageData)
    {
        // dd($imageData);
        $this->image = $imageData;
    }

    #[On('ticketSelected')]
    public function ticketSelected($ticketId)
    {
        $this->ticketId = $ticketId;
    }

    public function updated($newComment)
    {
        $this->validateOnly($newComment, ['newComment' => 'required|max:255']);
    }

    public function addComment()
    {
        $this->validate(['newComment' => 'required|max:255']);
        $image = $this->storeImage();

        $commentNew = Comment::create([
            'body' => $this->newComment,
            'image' => $image,
            'user_id' => 1,
            'support_ticket_id' => $this->ticketId
        ]);

        $this->newComment = "";
        $this->image = "";

        session()->flash('message', 'Comment added successfully 😃');
    }

    public function storeImage()
    {
        if ($this->image != NULL) {
            $img = ImageManagerStatic::make($this->image)->encode('jpg');
            $imageName = Str::random() . '.jpg';
            Storage::disk('public')->put($imageName, $img);
            return $imageName;
        } else {
            return null;
        }
    }

    public function remove($commentId)
    {
        $comment = Comment::find($commentId);

        if ($this->image != NULL) {
            Storage::disk('public')->delete($comment->image);
        } 

        $comment->delete();

        session()->flash('message', 'Comment removed successfully 😃');
    }
    public function render()
    {
        return view('livewire.comments', [
            'comments' => Comment::where('support_ticket_id', $this->ticketId)->orderByDesc('created_at')->simplePaginate(3)
        ]);
    }
}

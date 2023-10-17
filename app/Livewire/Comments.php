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
        $image = $this->storeImage();

        Comment::create([
            'body' => $this->newComment,
            'image' => $image,
            'user_id' => 1,
        ]);

        $this->newComment = "";
        $this->image = "";

        session()->flash('message', 'Comment added successfully 😃');
    }

    public function storeImage()
    {
        if (!$this->image) {
            return null;
        }

        $img = ImageManagerStatic::make($this->image)->encode('jpg');
        $imageName = Str::random() . 'jpg';
        Storage::disk('public')->put($imageName, $img);

        return $imageName;
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

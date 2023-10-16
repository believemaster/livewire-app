<?php

namespace App\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class Comments extends Component
{
    public $comments = [
        [
            'body' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim, fugit velit asperiores aspernatur mollitia soluta laboriosam ut vitae iste aliquam, nobis quae id. Voluptatibus, quisquam.',
            'created_at' => '3 min ago',
            'creator' => 'Yanik'
        ],
    ];
    public $newComment;


    public function addComment()
    {
        if($this->newComment == "") {
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

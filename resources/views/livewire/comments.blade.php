<div class="container">
    <div class="col-12">
        <h1 class="fw-bold">Comments</h1>
        <form class="my-4 flex" wire:submit.prevent="addComment">
            <input type="text" class="form-control rounded-0" placeholder="What's in your mind."
                wire:model.lazy="newComment" />
            <div class="py-2">
                <button type="submit" class="p-2 btn btn-info btn-sm rounded-0 shadow text-white">Add</button>
            </div>
        </form>
        @foreach ($comments as $comment)
            <div class="rounded-0 border shadow p-3 my-2">
                <div class="flex justify-start my-2">
                    <p class="fw-bold">{{ $comment->creator->name }}
                        <small class="mx-3 py-1 text-muted">({{ $comment->created_at->diffForHumans() }})</small>
                    </p>

                </div>
                <p class="text-secondary">{{ $comment->body }}</p>
            </div>
        @endforeach
    </div>
</div>

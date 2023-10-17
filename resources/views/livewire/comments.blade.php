<div class="container">
    <div class="col-12">
        <h1 class="fw-bold">Comments</h1>
        @if (session()->has('message'))
            <div class="alert alert-success rounded-0 shadow">
                {{ session('message') }}
            </div>
        @endif

        <section>
            @if ($image)
                <img src="{{ $image }}" width="200" />
            @endif
            <input id="image" type="file" wire:change="$dispatch('fileChosen')">
        </section>
        <form class="my-4 flex" wire:submit.prevent="addComment">

            <input type="text" class="form-control rounded-0" placeholder="What's in your mind."
                wire:model.live="newComment" />
            @error('newComment')
                <span class="text-danger">{{ $message }}</span>
            @enderror
            <div class="py-2">
                <button type="submit" class="p-2 btn btn-info btn-sm rounded-0 shadow text-white">Add</button>
            </div>
        </form>
        @forelse ($comments as $comment)
            <div class="rounded-0 border shadow p-3 my-2">
                <div class="flex justify-start my-2">

                    <p class="fw-bold">{{ $comment->creator->name }}
                        <small class="mx-3 py-1 text-muted">({{ $comment->created_at->diffForHumans() }})</small>
                        <a href="#" class="float-end text-danger" wire:click="remove({{ $comment->id }})">
                            <i class="fa fa-times"></i>
                        </a>
                    </p>
                </div>
                <p class="text-secondary">{{ $comment->body }}</p>
            </div>
        @empty
            No Comments
        @endforelse

        {{ $comments->links('pagination-links') }}
    </div>
</div>

<script>
    document.addEventListener('livewire:initialized', () => {
        @this.on('fileChosen', (event) => {
            // alert('File Chosen');
            let inputField = document.getElementById('image');
            let file = inputField.files[0];
            let reader = new FileReader();

            reader.onloadend = () => {
                // console.log(reader.result);
                @this.dispatch('fileUpload', {
                    'imageData': reader.result
                });
            }

            reader.readAsDataURL(file);
        });
    });
</script>

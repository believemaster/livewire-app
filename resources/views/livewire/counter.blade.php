<div class="text-center">
        <Button class="btn btn-success rounded-0" wire:click="increment">&#8679; Upvote</Button>
        <h3>{{ $counter }}</h3>
        <Button class="btn btn-danger rounded-0" wire:click="decrement">&#x21e9; Downvote</Button>
        <br />
        <button class="btn btn-info rounded-0 mt-3" wire:click="resetCounter">&#8597; Reset</button>
</div>

<div class="text-center">
        <Button class="btn btn-success rounded-0" wire:click="increment">+</Button>
        <h3>{{ $counter }}</h3>
        <Button class="btn btn-danger rounded-0" wire:click="decrement">-</Button>
        <br />
        <button class="btn btn-info rounded-0 mt-3" wire:click="resetCounter">Reset</button>
</div>

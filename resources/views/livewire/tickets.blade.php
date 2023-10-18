<div class="col-12">
    <h1 class="fw-bold">Tickets</h1>

    @forelse ($tickets as $ticket)
        <a href="#" class="btn rounded-0 border shadow p-3 my-2 {{ $active == $ticket->id ? 'bg-secondary text-white' : '' }}"
            wire:click="$dispatch('ticketSelected',{ ticketId: {{ $ticket->id }} })">
            <div class="flex justify-start my-2">
                <p>{{ $ticket->question }}
                    <small class="mx-3 py-1 text-muted">({{ $ticket->created_at->diffForHumans() }})</small>
                </p>
            </div>
        </a>
    @empty
        No Comments
    @endforelse
</div>

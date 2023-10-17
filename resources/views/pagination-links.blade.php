<div>
    @if ($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="">
            <span class="float-start">
                @if ($paginator->onFirstPage())
                    <span>Previous</span>
                @else
                    <button wire:click="previousPage" wire:loading.attr="disabled" rel="prev" class="btn btn-sm btn-info rounded-0 shadow text-white">Previous</button>
                @endif
            </span> 
            <span class="float-end">
                @if ($paginator->onLastPage())
                    <span>Next</span>
                @else
                    <button wire:click="nextPage" wire:loading.attr="disabled" rel="next" class="btn btn-sm btn-info rounded-0 shadow text-white">Next</button>
                @endif
            </span>
        </nav>
    @endif
</div>
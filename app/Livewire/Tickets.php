<?php

namespace App\Livewire;

use App\Models\SupportTicket;
use Livewire\Attributes\On;
use Livewire\Component;

class Tickets extends Component
{
    public $active;

    #[On('ticketSelected')]
    public function ticketSelected($ticketId)
    {
        $this->active = $ticketId;
    }
    public function render()
    {
        return view(
            'livewire.tickets',
            ['tickets' => SupportTicket::all(),]
        );
    }
}

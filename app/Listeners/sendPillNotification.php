<?php

namespace App\Listeners;

use App\Events\sendPill;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class sendPillNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(sendPill $event): void
    {
        
        \Livewire\Component::dispatch('bill');

        \Log::debug("Received event");
    }
}

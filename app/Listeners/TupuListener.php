<?php

namespace App\Listeners;

use App\Events\TupuEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class TupuListener
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
    public function handle(TupuEvent $mensaje): void
    {
        $mensaje= $event->mensaje;
    }
}

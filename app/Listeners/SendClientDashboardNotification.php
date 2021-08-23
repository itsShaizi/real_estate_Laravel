<?php

namespace App\Listeners;

use App\Events\SendClientDashboardTriggered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendClientDashboardNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  SendClientDashboardTriggered  $event
     * @return void
     */
    public function handle(SendClientDashboardTriggered $event)
    {
        //
    }
}

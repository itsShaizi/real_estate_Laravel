<?php

namespace App\Listeners;

use App\Events\ShowingRequestSubmitted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ShowingRequestNotification
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
     * @param  ShowingRequestSubmitted  $event
     * @return void
     */
    public function handle(ShowingRequestSubmitted $event)
    {
        //
    }
}

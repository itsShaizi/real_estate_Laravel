<?php

namespace App\Listeners;

use App\Events\RequestForInformationSubmitted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class RequestForInformationNotification
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
     * @param  RequestForInformationSubmitted  $event
     * @return void
     */
    public function handle(RequestForInformationSubmitted $event)
    {
        //
    }
}

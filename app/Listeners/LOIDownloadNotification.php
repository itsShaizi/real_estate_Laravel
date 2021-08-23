<?php

namespace App\Listeners;

use App\Events\LOIDownloadTriggered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LOIDownloadNotification
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
     * @param  LOIDownloadTriggered  $event
     * @return void
     */
    public function handle(LOIDownloadTriggered $event)
    {
        //
    }
}

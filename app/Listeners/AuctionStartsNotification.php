<?php

namespace App\Listeners;

use App\Events\AuctionStartsTriggered;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class AuctionStartsNotification
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
     * @param  AuctionStartsTriggered  $event
     * @return void
     */
    public function handle(AuctionStartsTriggered $event)
    {
        //
    }
}

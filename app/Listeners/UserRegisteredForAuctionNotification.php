<?php

namespace App\Listeners;

use App\Events\UserRegisteredForAuction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UserRegisteredForAuctionNotification
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
     * @param  UserRegisteredForAuction  $event
     * @return void
     */
    public function handle(UserRegisteredForAuction $event)
    {
        //
    }
}

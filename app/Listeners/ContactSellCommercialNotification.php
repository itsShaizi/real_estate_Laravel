<?php

namespace App\Listeners;

use App\Events\ContactSellCommercialSubmitted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class ContactSellCommercialNotification
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
     * @param  ContactSellCommercialSubmitted  $event
     * @return void
     */
    public function handle(ContactSellCommercialSubmitted $event)
    {
        //
    }
}

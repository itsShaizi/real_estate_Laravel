<?php

namespace App\Listeners;

use App\Events\SellerRequestForInformationSubmitted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SellerRequestForInformationNotification
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
     * @param  SellerRequestForInformationSubmitted  $event
     * @return void
     */
    public function handle(SellerRequestForInformationSubmitted $event)
    {
        //
    }
}

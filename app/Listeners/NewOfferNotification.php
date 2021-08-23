<?php

namespace App\Listeners;

use App\Events\NewOfferSubmitted;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use Illuminate\Support\Facades\Notification;
use App\Notifications\TraditionalOfferUserNotification;
use App\Notifications\TraditionalOfferStaffNotification;
use App\Models\User;

class NewOfferNotification
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
     * @param  NewOfferSubmitted  $event
     * @return void
     */
    public function handle(NewOfferSubmitted $event)
    {
        $user = User::find(1);
        if($event->offer->offer_type === 'traditional') {
            Notification::send($user, new TraditionalOfferUserNotification($user, $event->offer));
            Notification::send($user, new TraditionalOfferStaffNotification($user, $event->offer));
        } else {
            Notification::send($user, new TraditionalOfferUserNotification($user, $event->offer));
            Notification::send($user, new TraditionalOfferStaffNotification($user, $event->offer));
            //echo "sending an auction offer AWK to the user\n";
            //echo "sending a notification to the outbidded users\n";
            //echo "sending an auction offer alert to the staff\n";
        }
        //dd($event);
    }
}

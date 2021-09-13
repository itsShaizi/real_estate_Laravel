<?php

namespace App\Listeners;

use App\Models\User;
use App\Models\Offer;
use App\Events\NewOfferSubmitted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\TraditionalOfferUserNotification;
use App\Notifications\TraditionalOfferStaffNotification;
use App\Notifications\AuctionOfferOutbidUsersNotification;
use App\Notifications\AuctionOfferStaffNotification;
use App\Notifications\AuctionOfferUserNotification;

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
        //Get the user that made the offer
        $user = $event->offer->user;
        $staff = $event->offer->listing->contacts;

        if($event->offer->offer_type === 'traditional') {
            Notification::send($user, new TraditionalOfferUserNotification($user, $event->offer));
            Notification::send($staff, new TraditionalOfferStaffNotification($user, $event->offer));
        } else {
            //echo "sending an auction offer AWK to the user\n";
            Notification::send($user, new AuctionOfferUserNotification($user, $event->offer));
            //echo "sending an auction offer alert to the staff\n";
            Notification::send($staff, new AuctionOfferStaffNotification($user, $event->offer));
            //echo "sending a notification to the outbidded users\n";
            Notification::send($this->getOutbidUsers($event), new AuctionOfferOutbidUsersNotification($event->offer));
        }
    }

    private function getOutbidUsers($event)
    {
        return User::whereIn('id', Offer::where('listing_id', $event->offer->listing_id)->where('user_id','!=', $event->offer->user_id)->get()->pluck('user_id'))->get();
    }
}

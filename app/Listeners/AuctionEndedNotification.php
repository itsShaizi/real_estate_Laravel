<?php

namespace App\Listeners;

use App\Events\AuctionEndedTriggered;
use App\Models\User;
use App\Notifications\AuctionEndedLosingBiderNotification;
use App\Notifications\AuctionEndedStaffNotification;
use App\Notifications\AuctionEndedWinningOfferUserNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Notification;

class AuctionEndedNotification
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
     * @param  AuctionEndedTriggered  $event
     * @return void
     */
    public function handle(AuctionEndedTriggered $event)
    {
        foreach($event->auction->listings as $listing)
        {
            $offers = $listing->offers->where('auction_id', $event->auction->id)->sortByDesc('offer_amount');

            if($offers->count() > 0){

                $winningOffer = $offers->first();
                Notification::send($winningOffer->user , new AuctionEndedWinningOfferUserNotification($winningOffer));

                $losingBiders = User::whereIn('id', $offers->whereNotIn('user_id', $winningOffer->user_id)->unique('user_id')->pluck('user_id'))->get();
                Notification::send($losingBiders , new AuctionEndedLosingBiderNotification($listing));

                $staff = $listing->contacts;
                Notification::send($staff, new AuctionEndedStaffNotification($listing, $winningOffer, $offers->count()));
            }
        }

    }
}

<?php

namespace App\Listeners;

use App\Events\AuctionEndedTriggered;
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

            // if the auction ends and the person is the highest bid, then we informed that the person has won the bidding and an agent will be contacting him/her to close the sale
            // Inform to the highest bid offerer that an agent will be in contact with him.
            $winningOffer = $offers->first();
            Notification::send($winningOffer->user , new AuctionEndedWinningOfferUserNotification($winningOffer));

            // if the auction ends and that person is not the highest bid, we inform with another email (and possible SMS... but that for later, we use Twillio) that he/she was outbidded and the auction ended
            // Inform the offerers that didn't win the auction (Email & SMS)
        }

        // when the auction ends we also need to notify the staff,
        // with how many offers, and who won the auction so the agent can get in contact with the person
    }
}

<?php

namespace App\Http\Livewire\Listings\Frontend;

use Livewire\Component;
use App\Events\NewOfferSubmitted;
use App\Actions\CreateOfferAction;
use App\Support\CurrencyExchangeRates;

class AuctionOffer extends Component
{
    public $listing;
    public $auction;
    public $eventIsActive = true;
    public $list_price;
    public $current_bid_suggestion;
    public $offer_amount;

    public function mount($listing)
    {
        $this->listing = $listing;

        $this->auction = $this->listing->auction()
            ->where('end_date', '>=', now()->format('Y-m-d'))
            ->first();

        // Check if the auction event is active
        //if ($this->auction && $this->auction->end_time >= now()->format('H:i:s') && $this->auction->start_time <= now()->format('H:i:s')) {
        //    $this->eventIsActive = false;
        //}
    }

    public function getListeners()
    {
        return [
            'bidPlaced' => '$refresh',
            "echo:listing-{$this->listing->id},NewOfferSubmitted" => '$refresh',
        ];
    }

    public function submit()
    {
        // Check if the user is logged in
        if (!auth()->check()) {
            $this->dispatchBrowserEvent('open-login');

            return;
        }

        // Check if the offer is placed (not empty)
        if (!$this->offer_amount) {
            $this->dispatchBrowserEvent('alert-message', [
                'alert_message' => 'Place an offer first'
            ]);

            return;
        }

        // Check if the offer is numeric
        if (!is_numeric($this->offer_amount)) {
            $this->dispatchBrowserEvent('alert-message', [
                'alert_message' => 'Please insert only numbers.'
            ]);

            return;
        }

        // Check if the offer is bigger then the last bid
        if ($this->offer_amount <= $this->current_bid_suggestion) {
            $this->dispatchBrowserEvent('alert-message', [
                'alert_message' => 'Your offer must be higher than the current highest offer'
            ]);

            return;
        }

        $offer = (new CreateOfferAction)->handle([
            'offer_type' => 'auction',
            'offer_amount' => $this->offer_amount,
        ], auth()->id(), $this->listing->id, $this->auction->id);

        if ($offer->wasRecentlyCreated && $this->listing->listing_type === 'auction') {
            event(new NewOfferSubmitted($offer));
        }

        $this->dispatchBrowserEvent('show-message', [
            'message' => 'Offer submitted successfully!',
            'message_details' => 'One of our Agents will get in touch with you very soon.'
        ]);

        $this->reset('offer_amount');

        $this->emitSelf('bidPlaced');
    }

    public function render(CurrencyExchangeRates $exchange)
    {
        $this->list_price = $exchange->convert($this->listing->list_price);

        $this->current_bid_suggestion = $exchange->convert($this->listing->offers->max('offer_amount') ?? 0);

        return view('livewire.listings.frontend.auction-offer', [
            'current_bid_suggestion' => $this->current_bid_suggestion,
            'previous_bids' => $this->listing->offers->sortByDesc('created_at')->map(function ($bid) use ($exchange) {
                return [
                    'created_at' => $bid->created_at,
                    'offer_amount' => $exchange->convert($bid->offer_amount)
                ];
            })
        ]);
    }
}

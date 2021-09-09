<?php

namespace App\Http\Livewire\Listings\Frontend;

use App\Models\Offer;
use App\Models\Listing;
use Livewire\Component;
use App\Actions\CreateOfferAction;
use App\Support\CurrencyExchangeRates;

class TraditionalSale extends Component
{
    public Listing $listing;
    public $list_price;
    public $offer_amount;

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

        // Check if the user has alredy place and offer for this listing
        if (Offer::where('listing_id', $this->listing->id)->where('user_id', auth()->id())->first()) {
            $this->dispatchBrowserEvent('alert-message', [
                'alert_message' => 'You have already submit and offer for this listing.'
            ]);

            return;
        }

        (new CreateOfferAction)->handle([
            'offer_type' => 'traditional',
            'offer_amount' => $this->offer_amount,
        ], auth()->id(), $this->listing->id);

        $this->dispatchBrowserEvent('show-message', [
            'message' => 'Offer submitted successfully!',
            'message_details' => 'One of our Agents will get in touch with you very soon.'
        ]);

        $this->reset('offer_amount');
    }

    public function render(CurrencyExchangeRates $exchange)
    {
        return view('livewire.listings.frontend.traditional-sale', [
            'list_price' => $exchange->convert($this->listing->list_price)
        ]);
    }
}

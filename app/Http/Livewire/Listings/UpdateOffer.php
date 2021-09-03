<?php

namespace App\Http\Livewire\Listings;

use App\Models\Offer;
use Livewire\Component;

class UpdateOffer extends Component
{
    public $offer;
    public $outcome = null;
    public $details = null;

    protected $listeners = [
        'updateOffer'
    ];

    public function updateOffer(Offer $offer)
    {
        $this->reset();

        $this->offer = $offer;

        $this->outcome = $this->offer->outcome;

        $this->details = $this->offer->details;
    }

    public function update()
    {
        $this->validate([
            'outcome' => ['required'],
            'details' => ['required', 'string', 'max:512'],
        ]);

        $this->offer->update([
            'outcome' => $this->outcome,
            'details' => $this->details
        ]);

        $this->emit('offerUpdated');

        $this->dispatchBrowserEvent('offer-updated');
    }

    public function render()
    {
        return view('livewire.listings.update-offer');
    }
}

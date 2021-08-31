<?php

namespace App\Http\Livewire;

use App\Models\Country;
use App\Models\Listing;
use App\Models\State;
use Carbon\Carbon;
use Livewire\Component;

class ShowListings extends Component
{
    public $countries;
    public $states = null;
    public $filters = [
        's_query' => null,
        'country_id' => null,
        'state_id' => null,
        'zip' => null,
        'property_type' => null,
        'listing_type' => null,
        'status' => null,
        'min_price' => null,
        'max_price' => null,
    ];

    public function mount()
    {
        $this->countries = Country::all();
    }

    public function updatedFiltersCountryId($country_id)
    {
        $this->states = State::where('country_id', $country_id)->get();
    }

    public function clearFilters()
    {
        $this->filters = [
            's_query' => null,
            'country_id' => null,
            'state_id' => null,
            'zip' => null,
            'property_type' => null,
            'listing_type' => null,
            'status' => null,
            'min_price' => null,
            'max_price' => null,
        ];
    }

    public function getListingsQueryProperty()
    {
        return Listing::query()
            ->when($this->filters['s_query'], fn ($query, $search) => $query->where('address', 'LIKE', '%' . $search . '%')
                ->orWhere('listing_title', 'LIKE', '%' . $search . '%')
                ->orWhere('city', 'LIKE', '%' . $search . '%'))
            ->when($this->filters['country_id'], fn ($query, $search) => $query->where('country_id', $search))
            ->when($this->filters['state_id'], fn ($query, $search) => $query->where('state_id', $search))
            ->when($this->filters['zip'], fn ($query, $search) => $query->where('zip', 'LIKE', '%' . $search . '%'))
            ->when($this->filters['property_type'], fn ($query, $search) => $query->where('property_type', $search))
            ->when($this->filters['listing_type'], fn ($query, $search) => $query->where('listing_type', $search))
            ->when($this->filters['status'], fn ($query, $search) => $query->where('status', $search))
            ->when($this->filters['min_price'], fn ($query, $search) => $query->where('list_price', '>=', $search))
            ->when($this->filters['max_price'], fn ($query, $search) => $query->where('list_price', '<=', $search))
            ;
    }

    public function getListingsProperty()
    {
        return $this->ListingsQuery->paginate(20);
    }

    public function render()
    {
        return view('livewire.show-listings', [
            'listings' => $this->listings
        ])->layout('components.backend.layout');
    }
}

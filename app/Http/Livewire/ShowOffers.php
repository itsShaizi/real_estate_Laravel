<?php

namespace App\Http\Livewire;

use App\Models\Offer;
use App\Models\State;
use Livewire\Component;

class ShowOffers extends Component
{
    public $type;
    public $countries;
    public $orderBy = 'created_at';
    public $orderByDirection = 'desc';
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
        'min_amount' => null,
        'max_amount' => null,
        'user' => null,
    ];

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
            'status' => null,
            'min_price' => null,
            'max_price' => null,
            'min_amount' => null,
            'max_amount' => null,
            'user' => null,
        ];
    }

    public function getOffersQueryProperty()
    {
        return Offer::query()->where('offer_type', $this->type)
            ->whereHas('listing', fn ($query) => $query
                ->when($this->filters['s_query'], fn ($query, $search) => $query
                    ->where('address', 'LIKE', '%' . $search . '%')
                    ->orWhere('listing_title', 'LIKE', '%' . $search . '%')
                    ->orWhere('slug', 'LIKE', '%' . $search . '%')
                    ->orWhere('city', 'LIKE', '%' . $search . '%'))
                ->when($this->filters['country_id'], fn ($query, $search) => $query->where('country_id', $search))
                ->when($this->filters['state_id'], fn ($query, $search) => $query->where('state_id', $search))
                ->when($this->filters['zip'], fn ($query, $search) => $query->where('zip', 'LIKE', '%' . $search . '%'))
                ->when($this->filters['property_type'], fn ($query, $search) => $query->where('property_type', $search))
                ->when($this->filters['status'], fn ($query, $search) => $query->where('status', $search))
                ->when($this->filters['min_price'], fn ($query, $search) => $query->where('list_price', '>=', $search))
                ->when($this->filters['max_price'], fn ($query, $search) => $query->where('list_price', '<=', $search)))
            ->when($this->filters['min_amount'], fn ($query, $search) => $query->where('offer_amount', '>=', $search))
            ->when($this->filters['max_amount'], fn ($query, $search) => $query->where('offer_amount', '<=', $search))
            ->whereHas('user', fn ($query) => $query
                ->when($this->filters['user'], fn ($query, $search) => $query
                    ->where('first_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                    ->orWhere('email', 'LIKE', '%' . $search . '%')))
            ->orderBy($this->orderBy,$this->orderByDirection);
    }

    public function getOffersProperty()
    {
        return $this->offersQuery->paginate(20);
    }

    public function render()
    {
        return view('livewire.show-offers', [
            'offers' => $this->offers
        ]);
    }
}

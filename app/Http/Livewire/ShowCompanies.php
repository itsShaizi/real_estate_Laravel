<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Country;
use App\Models\State;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCompanies extends Component
{
    use WithPagination;

    public $countries;
    public $states = null;
    public $orderBy = 'name';
    public $orderByDirection = 'asc';
    public $filters = [
        'name' => null,
        'type' => null,
        'country_id' => null,
        'state_id' => null,
        'city' => null,
        'address' => null,
        'zip' => null,
        'active' => null,
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
        $this->orderBy = 'name';
        $this->orderByDirection = 'asc';
        $this->filters = [
            'name' => null,
            'type' => null,
            'country_id' => null,
            'state_id' => null,
            'city' => null,
            'address' => null,
            'zip' => null,
            'active' => null,
        ];
    }

    public function getCompaniesQueryProperty()
    {
        return Company::query()
        ->when($this->filters['name'], fn($query, $search) => $query->where('name','like','%'.$search.'%'))
        ->when($this->filters['type'], fn($query, $search) => $query->where('type',$search))
        ->when($this->filters['country_id'], fn($query, $search) => $query->where('country_id',$search))
        ->when($this->filters['state_id'], fn($query, $search) => $query->where('state_id',$search))
        ->when($this->filters['city'], fn($query, $search) => $query->where('city','like','%'.$search.'%'))
        ->when($this->filters['address'], fn($query, $search) => $query->where('address','like','%'.$search.'%'))
        ->when($this->filters['zip'], fn($query, $search) => $query->where('zip','like','%'.$search.'%'))
        ->when($this->filters['active'], fn($query, $search) => $query->where('active',$search))
        ->when($this->filters['active'] == '0', fn($query) => $query->where('active','0'))
        ->orderBy($this->orderBy,$this->orderByDirection)
        ;
    }

    public function getCompaniesProperty(){
        return $this->companiesQuery
        ->paginate(20);
    }

    public function render()
    {
        return view('livewire.show-companies',[
            'companies' => $this->companies,
            'states' => $this->states,
        ])->layout('components.backend.layout');
    }
}

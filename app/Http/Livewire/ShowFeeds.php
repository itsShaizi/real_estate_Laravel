<?php

namespace App\Http\Livewire;

use App\Http\Livewire\DataTable\WithSorting;
use App\Models\Country;
use App\Models\Feed;
use App\Models\Listing;
use Livewire\Component;
use Illuminate\Support\Str;
use Livewire\WithPagination;

class ShowFeeds extends Component
{
    use WithPagination, WithSorting;

    public $feeds;
    public $countries;
    public $filters = [];
    public $states = null;
    public $selectedFeeds = [];
    public $showFilters = false;
    public $filter = [
        'country_id' => '',
        'city' => null,
        'zip' => null,
        'property_type' => '',
        'listing_type' => '',
        'min_price' => null,
        'max_price' => null,
        'min_dom' => null,
        'max_dom' => null,
    ];

    public function mount()
    {
        $this->feeds = Feed::all();
        $this->countries = Country::whereIn('id', Listing::select('country_id')->groupBy('country_id')->pluck('country_id'))->get();
        $this->selectedFeeds = $this->feeds->pluck('name');
        if(count($this->filters) == 0){
            $this->filters[] = $this->filter;
        }
    }

    public function getListingsProperty()
    {
        $listings = Listing::query();

        $atLeastOneFilter = false;

        foreach ($this->filters as $key => $filter) {
            if($filter != $this->filter){
                $atLeastOneFilter = true;

                $listings->orWhere(function ($query) use ($filter) {
                    $query->whereIn('feed_source', $this->selectedFeeds)
                        ->when($filter['country_id'], fn ($query, $search) => $query->where('country_id', $search))
                        ->when($filter['city'], fn ($query, $search) => $query->where('city', 'LIKE', '%'.$search.'%'))
                        ->when($filter['zip'], function ($query, $search) {
                            $zips = explode(',', $search);
                            $query->where(function ($query) use ($zips) {
                                foreach($zips as $zip){
                                    $query->orWhere('zip', 'LIKE', '%' . Str::of($zip)->trim() . '%');
                                }
                            });
                        })
                        ->when($filter['property_type'], fn ($query, $search) => $query->where('property_type', $search))
                        ->when($filter['listing_type'], fn ($query, $search) => $query->where('listing_type', $search))
                        ->when($filter['min_price'], fn ($query, $search) => $query->where('list_price', '>=', $search))
                        ->when($filter['max_price'], fn ($query, $search) => $query->where('list_price', '<=', $search))
                        ->when($filter['min_dom'], fn ($query, $search) => $query->whereRaw('DATEDIFF(NOW() , listing_date) > ?', [$search]))
                        ->when($filter['max_dom'], fn ($query, $search) => $query->whereRaw('DATEDIFF(NOW() , listing_date) < ?', [$search]))
                        ;
                });

            }
        }

        if(!$atLeastOneFilter){
            $listings->whereIn('feed_source', $this->selectedFeeds);
        }

        return $this->applySorting($listings);
    }

    public function setUpTo150k($key){
        $this->filters[$key]['min_price'] = '0';
        $this->filters[$key]['max_price'] = '150000';
    }

    public function setFrom150kTo500k($key){
        $this->filters[$key]['min_price'] = '150000';
        $this->filters[$key]['max_price'] = '500000';
    }

    public function setFrom500kTo1m($key){
        $this->filters[$key]['min_price'] = '500000';
        $this->filters[$key]['max_price'] = '1000000';
    }

    public function setMoreThan1m($key){
        $this->filters[$key]['min_price'] = '1000000';
        $this->filters[$key]['max_price'] = null;
    }

    public function setUpTo90d($key){
        $this->filters[$key]['min_dom'] = '0';
        $this->filters[$key]['max_dom'] = '90';
    }

    public function setFrom90dTo180d($key){
        $this->filters[$key]['min_dom'] = '90';
        $this->filters[$key]['max_dom'] = '180';
    }

    public function setFrom180dTo1Y($key){
        $this->filters[$key]['min_dom'] = '180';
        $this->filters[$key]['max_dom'] = '365';
    }

    public function setMoreThan1Y($key){
        $this->filters[$key]['min_dom'] = '365';
        $this->filters[$key]['max_dom'] = null;
    }

    public function clearPriceRange($key)
    {
        $this->filters[$key]['min_price'] = null;
        $this->filters[$key]['max_price'] = null;
    }

    public function clearDomRange($key)
    {
        $this->filters[$key]['min_dom'] = null;
        $this->filters[$key]['max_dom'] = null;
    }

    public function clearFilter($key)
    {
        if(count($this->filters) == 1)
        {
            $this->filters[$key] = $this->filter;
        }else{
            array_splice($this->filters, $key, 1);
        }
    }

    public function removeFilters()
    {
        $this->filters = [];
        $this->filters[] = $this->filter;
        $this->showFilters = false;
    }

    public function addFitler()
    {
        $this->filters[] = $this->filter;
    }

    public function export()
    {
        return response()->streamDownload(function(){
            echo $this->listings
            ->join('countries','country_id','countries.id')
            ->join('states','state_id','states.id')
            ->select('listing_title','address','zip','county','municipality','states.iso2 as state','countries.iso2 as country','listings.latitude','listings.longitude','status','lot_size','lot_size_unit','property_size','list_price','list_price_unit','listing_type','property_type')->toCsv();
        }, 'listings.csv');
    }

    public function render()
    {
        return view('livewire.show-feeds', [
            'listings' => $this->listings->get(),
        ])->layout('components.backend.layout');
    }
}

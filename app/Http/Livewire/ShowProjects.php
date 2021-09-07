<?php

namespace App\Http\Livewire;

use App\Models\Company;
use App\Models\Project;
use App\Models\ListingProject;
use App\Models\Listing;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ShowProjects extends Component
{   
    use WithPagination;

    public $companies;
    public $orderBy = 'created_at';
    public $orderByDirection = 'desc';
    public $filters = [
        's_query' => null,
        'business_id' => null,
        'number_block' => null,
        'number_floor' => null,
        'number_flat' => null,
        'date_finish_from' => null,
        'date_finish_to' => null,
        'date_sell_from' => null,
        'date_sell_to' => null,
        'price_from' => null,
        'price_to' => null,
        'status' => null,
    ];

    public function mount()
    {
        $this->companies = Company::all();
    }

    public function clearFilters()
    {
        $this->filters = [
            's_query' => null,
            'business_id' => null,
            'number_block' => null,
            'number_floor' => null,
            'number_flat' => null,
            'date_finish_from' => null,
            'date_finish_to' => null,
            'date_sell_from' => null,
            'date_sell_to' => null,
            'price_from' => null,
            'price_to' => null,
            'status' => null,
        ];
    }

    public function getProjectsQueryProperty()
    {
        return Project::query()
            ->when($this->filters['s_query'], fn ($query, $search) => $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('description', 'LIKE', '%' . $search . '%')
                ->orWhere('content', 'LIKE', '%' . $search . '%')
                ->orWhere('location', 'LIKE', '%' . $search . '%'))
            ->when($this->filters['business_id'], fn ($query, $search) => $query->where('business_id', $search))
            ->when($this->filters['number_block'], fn ($query, $search) => $query->where('number_block', $search))
            ->when($this->filters['number_floor'], fn ($query, $search) => $query->where('number_floor', $search))
            ->when($this->filters['number_flat'], fn ($query, $search) => $query->where('number_flat', $search))
            ->when($this->filters['date_finish_from'], fn($query, $search) => $query->where('date_finish','>=',Carbon::parse($search)))
            ->when($this->filters['date_finish_to'], fn($query, $search) => $query->where('date_finish','<=',Carbon::parse($search)->endOfDay()))
            ->when($this->filters['date_sell_from'], fn($query, $search) => $query->where('date_sell','>=',Carbon::parse($search)))
            ->when($this->filters['date_sell_to'], fn($query, $search) => $query->where('date_sell','<=',Carbon::parse($search)->endOfDay()))
            ->when($this->filters['price_from'], fn ($query, $search) => $query->where('price_from', '>=', $search))
            ->when($this->filters['price_to'], fn ($query, $search) => $query->where('price_to', '<=', $search))
            ->when($this->filters['status'], fn ($query, $search) => $query->where('status', $search))
            ->orderBy($this->orderBy,$this->orderByDirection)
            ;
    }

    public function getProjectsProperty()
    {
        return $this->ProjectsQuery->paginate(20);
    }

    public function render()
    {
        return view('livewire.show-projects', [
            'projects' => $this->projects
        ])->layout('components.backend.layout');
    }
}

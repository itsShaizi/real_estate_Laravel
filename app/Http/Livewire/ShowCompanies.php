<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class ShowCompanies extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        return view('livewire.show-companies',[
            'companies' => Company::query()
            ->where('name','like','%'.$this->search.'%')
            ->paginate(20),
        ])->layout('components.backend.layout');
    }
}

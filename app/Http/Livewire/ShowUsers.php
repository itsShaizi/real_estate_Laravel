<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ShowUsers extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {
        return view('livewire.show-users',[
            'users' => User::query()
            ->where('last_name','like','%'.$this->search.'%')
            ->paginate(20),
        ])->layout('components.backend.layout');
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Role;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithPagination;

class ShowUsers extends Component
{
    use WithPagination;

    public $roles;
    public $orderBy = 'last_name';
    public $orderByDirection = 'asc';
    public $filters = [
        'first_name' => null,
        'last_name' => null,
        'email' => null,
        'created_from' => null,
        'created_to' => null,
        'role_id' => null,
    ];

    public function mount ()
    {
        $this->roles = Role::all();
    }

    public function clearFilters()
    {
        $this->orderBy = 'last_name';
        $this->orderByDirection = 'asc';
        $this->filters = [
            'first_name' => null,
            'last_name' => null,
            'email' => null,
            'created_from' => null,
            'created_to' => null,
            'role_id' => null,
        ];
    }

    public function getUsersQueryProperty()
    {
        return User::query()
        ->when($this->filters['first_name'], fn($query, $search) => $query->where('first_name','like','%'.$search.'%'))
        ->when($this->filters['last_name'], fn($query, $search) => $query->where('last_name','like','%'.$search.'%'))
        ->when($this->filters['email'], fn($query, $search) => $query->where('email','like','%'.$search.'%'))
        ->when($this->filters['created_from'], fn($query, $search) => $query->where('created_at','>=',Carbon::parse($search)))
        ->when($this->filters['created_to'], fn($query, $search) => $query->where('created_at','<=',Carbon::parse($search)->endOfDay()))
        ->when($this->filters['role_id'], fn($query, $search) => $query->where('role_id', $search))
        ->orderBy($this->orderBy,$this->orderByDirection)
        ;
    }

    public function getUsersProperty()
    {
        return $this->usersQuery->paginate(20);
    }

    public function render()
    {
        return view('livewire.show-users',[
            'users' => $this->users,
        ])->layout('components.backend.layout');
    }
}

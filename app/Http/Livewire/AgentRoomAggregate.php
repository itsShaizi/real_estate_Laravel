<?php

namespace App\Http\Livewire;

use App\Models\Listing;
use App\Models\Project;
use App\Models\User;
use Livewire\Component;

class AgentRoomAggregate extends Component
{
    public $totalListings;
    public $totalProjects;
    public $totalUsers;

    public function mount()
    {

        $this->totalUsers = User::all()->count();
        $this->totalListings = Listing::all()->count();
        $this->totalProjects = Project::all()->count();



    }

    public function render()
    {
        return view('livewire.agent-room-aggregate');
    }
}

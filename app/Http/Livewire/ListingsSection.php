<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class ListingsSection extends Component
{
    public $user;
    public $listings;

    public function render()
    {
        return view('livewire.listings-section');
    }
}

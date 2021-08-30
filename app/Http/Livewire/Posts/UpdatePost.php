<?php

namespace App\Http\Livewire\Posts;

use Livewire\Component;

class UpdatePost extends Component
{
    public function render()
    {
        return view('livewire.posts.update-post')
            ->layout('components.backend.layout');
    }
}

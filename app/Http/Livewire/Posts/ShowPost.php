<?php

namespace App\Http\Livewire\Posts;

use Livewire\Component;

class ShowPost extends Component
{
    public function render()
    {
        return view('livewire.posts.show-post')
            ->layout('components.backend.layout');
    }
}

<?php

namespace App\Http\Livewire\Posts;

use Livewire\Component;

class ListPosts extends Component
{
    public function render()
    {
        return view('livewire.posts.list-posts')
            ->layout('components.backend.layout');
    }
}

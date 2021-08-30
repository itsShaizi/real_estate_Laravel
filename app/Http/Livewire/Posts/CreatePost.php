<?php

namespace App\Http\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;

class CreatePost extends Component
{
    public Post $post;
    public $selectedTags;
    public $unselectedTags;

    protected $rules = [
        'post.title' => 'required|string|max:300|min:15',
        'post.content' => 'required'
    ];

    public function mount()
    {
        $this->post = new Post;
        $this->selectedTags = [];
        $this->unselectedTags = [];

    }

    public function render()
    {
        return view('livewire.posts.create-post')
            ->layout('components.backend.layout');
    }
}

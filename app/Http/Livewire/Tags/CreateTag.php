<?php

namespace App\Http\Livewire\Tags;

use Livewire\Component;
use App\Models\Tag;

class CreateTag extends Component
{
    public Tag $tag;
    public bool $showUpdateForm;

    protected $rules = [
        'tag.content' => 'required|string|max:40|min:2',
    ];

    public function mount()
    {
        $this->tag = new Tag;
        $this->showUpdateForm = false;
    }

    public function render()
    {
        return view('livewire.tags.create-tag')
            ->layout('components.backend.layout');
    }

    public function delete(Tag $tag)
    {
        $tag->delete();
    }

    public function edit(Tag $tag)
    {
        $this->tag = $tag;
        $this->showUpdateForm = true;
    }

    public function resetValues()
    {
        $this->tag = new Tag;
        $this->showUpdateForm = false;
    }

    public function save()
    {
        $this->validate();

        $this->tag->save();
        $this->tag->content = "";
    }

    public function update()
    {
        $this->validate();
        $this->tag->save();
        $this->resetValues();

    }
    

    public function getTagsProperty()
    {
        return Tag::all();
    }
}

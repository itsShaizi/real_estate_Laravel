<?php

namespace App\Http\Livewire\Projects;

use App\Models\Image;
use App\Models\Project;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class FetchImages extends Component
{
    public $project;

    protected $listeners = [
        'image-uploaded' => '$refresh'
    ];

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function deleteImage(Image $image)
    {
        $original_filename = $image->ref_id . '/original/' . $image->title;
        $thumb_filename = $image->ref_id . '/thumb/' . $image->title;
        
        if (Storage::disk('projects')->exists($original_filename)) {
            Storage::disk('projects')->delete($original_filename);
        }
        
        if (Storage::disk('projects')->exists($thumb_filename)) {
            Storage::disk('projects')->delete($thumb_filename);
        }

        $image->delete();

        $this->dispatchBrowserEvent('alert-message', [
            'message' => 'Image deleted successfully.'
        ]);
    }

    public function render()
    {
        return view('livewire.projects.fetch-images', [
            'images' => $this->project->images->fresh()
        ]);
    }
}

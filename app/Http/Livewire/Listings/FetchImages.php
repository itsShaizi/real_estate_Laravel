<?php

namespace App\Http\Livewire\Listings;

use App\Models\Image;
use App\Models\Listing;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class FetchImages extends Component
{
    public $listing;

    protected $listeners = [
        'image-uploaded' => '$refresh'
    ];

    public function mount(Listing $listing)
    {
        $this->listing = $listing;
    }

    public function deleteImage(Image $image)
    {
        $original_filename = $image->ref_id . '/original/' . $image->title;
        $thumb_filename = $image->ref_id . '/thumb/' . $image->title;
        
        if (Storage::disk('listings')->exists($original_filename)) {
            Storage::disk('listings')->delete($original_filename);
        }
        
        if (Storage::disk('listings')->exists($thumb_filename)) {
            Storage::disk('listings')->delete($thumb_filename);
        }

        $image->delete();

        $this->dispatchBrowserEvent('alert-message', [
            'message' => 'Image deleted successfully.'
        ]);
    }

    public function render()
    {
        return view('livewire.listings.fetch-images', [
            'images' => $this->listing->images->fresh()
        ]);
    }
}

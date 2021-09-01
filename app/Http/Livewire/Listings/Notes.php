<?php

namespace App\Http\Livewire\Listings;

use App\Models\Listing;
use Livewire\Component;
use App\Models\ListingNote;

class Notes extends Component
{
    public Listing $listing;
    public $new_note = null;
    public $update_note = null;

    public function saveNote($note_id = null)
    {
        $this->validate([
            'new_note' => 'required|string|max:512'
        ]);

        $this->listing->notes()->updateOrCreate(['id' => $note_id], [
            'user_id' => auth()->id(),
            'notes' => $this->new_note,
        ]);

        $this->dispatchBrowserEvent('alert-message', [
            'message' => 'Note added successfully.'
        ]);

        $this->reset('new_note');
    }

    public function updateNote(ListingNote $note)
    {
        $this->validate([
            'update_note' => 'required|string|max:512'
        ]);

        $note->update([
            'notes' => $this->update_note,
        ]);

        $this->dispatchBrowserEvent('alert-message', [
            'message' => 'Note updated successfully.'
        ]);

        $this->reset('new_note');
    }

    public function delete(ListingNote $note)
    {
        $note->delete();

        $this->dispatchBrowserEvent('alert-message', [
            'message' => 'Note deleted successfully.'
        ]);
    }

    public function render()
    {
        return view('livewire.listings.notes', [
            'listing_notes' => $this->listing->fresh()->notes
        ]);
    }
}

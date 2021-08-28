<?php

namespace App\Http\Livewire\Listings;

use App\Models\User;
use App\Models\Group;
use App\Models\Listing;
use Livewire\Component;
use App\Models\ListingUser;

class Contacts extends Component
{
    public Listing $listing;
    public $group_id = null;
    public $contact_id = null;

    protected $rules = [
        'group_id' => ['required', 'integer', 'exists:groups,id'],
        'contact_id' => ['required', 'integer', 'exists:users,id'],
    ];

    protected $validationAttributes = [
        'group_id' => 'group',
        'contact_id' => 'contact',
    ];

    protected $listeners = [
        'contact_id' => 'setContactId'
    ];

    public function setContactId($contact_id)
    {
        $this->contact_id = $contact_id;
    }

    public function addContact()
    {
        $this->validate();

        // Validate that the Contact dont was added before on the same group
        if (
            $this->listing
                ->contacts()
                ->wherePivot('user_id', $this->contact_id)
                ->wherePivot('group_id', $this->group_id)
                ->exists()
        ) {
            $this->addError('contact_exists', 'The contact its already assigned to this group.');

            return;
        }

        $user = User::find($this->contact_id);

        $user->groups()
            ->syncWithoutDetaching($this->group_id);

        $this->listing
            ->contacts()
            ->attach($user, ['group_id' => $this->group_id]);

        // Emit and event to update the input fields on General Info Tab
        $this->emitTo('user-search-component', 'resetComponent', 'contact_id');

        $this->dispatchBrowserEvent('alert-message', [
            'message' => 'Contact added successfully.'
        ]);

        $this->reset('group_id', 'contact_id');
    }

    public function removeContact($contact_id, $group_id)
    {
        $this->listing
            ->contacts()
            ->wherePivot('group_id', $group_id)
            ->detach($contact_id);

        // Check if the contact was set as a main contact and remove it from the listings table
        $group = Group::find($group_id)->slug;

        if ($this->listing->$group == $contact_id) {
            $this->listing->update([
                $group => null
            ]);
        }

        // Emit and event to update the input fields on General Info Tab
        $this->emitTo('user-search-component', 'mainAgentUpdated', null, $group);

        $this->dispatchBrowserEvent('alert-message', [
            'message' => 'Contact removed successfully.'
        ]);
    }

    public function setMainAgent($contact_id, $group)
    {
        $this->listing->update([
            $group => $contact_id
        ]);

        // Emit and event to update the input fields on General Info Tab
        $this->emitTo('user-search-component', 'mainAgentUpdated', $contact_id, $group);

        $this->dispatchBrowserEvent('alert-message', [
            'message' => 'Contact set as Main Agent successfully.'
        ]);
    }

    public function render()
    {
        return view('livewire.listings.contacts', [
            'groups' => Group::orderBy('name')
                ->get()
                ->pluck('name', 'id'),
            'contacts' => ListingUser::with(['user', 'group'])
                ->where('listing_id', $this->listing->id)
                ->get()
        ]);
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\License;
use App\Models\State;
use Livewire\Component;

class LicensesSection extends Component
{
    public $countries;
    public $states;
    public $user;
    public $editing;
    public $sectionTitle;
    public $message = '';
    public $showEditSection = false;

    protected $rules = [
        'editing.country_id' =>'required|integer',
        'editing.state_id' =>'required|integer',
        'editing.license_type' => 'required|string',
        'editing.license_number' => 'nullable|string|max:85',
        'editing.license_description' => 'nullable|string',
    ];

    public function mount()
    {
        $this->makeBlankEditing();
    }

    public function makeBlankEditing()
    {
        $this->editing = new License;
    }

    public function new()
    {
        $this->makeBlankEditing();
        $this->sectionTitle = 'New License';
        $this->message = 'License added successfully.';
        $this->showEditSection = true;
    }

    public function save()
    {
        $this->validate();
        $this->user->licenses()->save($this->editing);
        $this->user->refresh();
        $this->makeBlankEditing();
        $this->showEditSection = false;
        $this->dispatchBrowserEvent('alert-message', [
            'message' => $this->message
        ]);
    }

    public function edit($id){
        $license = $this->user->licenses->where('id',$id)->first();
        $this->states = $this->getStates($license->country_id);
        $this->editing = $license;
        $this->sectionTitle = 'Edit License';
        $this->message = 'License updated successfully.';
        $this->showEditSection = true;
    }

    public function remove($id)
    {
        $license = $this->user->licenses->find($id);
        $license->delete();
        $this->makeBlankEditing();
        $this->showEditSection = false;
        $this->user->refresh();

        $this->dispatchBrowserEvent('alert-message', [
            'message' => 'License removed successfully.'
        ]);
    }

    public function updatedEditingCountryId($country_id)
    {
        $this->states = $this->getStates($country_id);
        $this->editing->state_id = null;
    }

    public function getStates($country_id)
    {
        return State::where('country_id', $country_id)->get();
    }
    public function render()
    {
        return view('livewire.licenses-section');
    }
}

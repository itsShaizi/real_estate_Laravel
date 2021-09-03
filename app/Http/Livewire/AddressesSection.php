<?php

namespace App\Http\Livewire;

use App\Models\State;
use App\Models\Address;
use Livewire\Component;

class AddressesSection extends Component
{
    public $countries;
    public $states;
    public $user;
    public $editing;
    public $sectionTitle;
    public $message = '';
    public $showEditSection = false;

    protected $rules = [
        'editing.address_type' =>'required|string',
        'editing.country_id' =>'required|integer',
        'editing.state_id' =>'required|integer',
        'editing.city' =>'required|string',
        'editing.address' =>'required|string',
        'editing.zip' =>'required|string',
        'editing.sort_order' =>'nullable',
    ];

    public function mount()
    {
        $this->makeBlankEditing();
    }

    public function makeBlankEditing()
    {
        $this->editing = new Address;
    }

    public function new()
    {
        $this->makeBlankEditing();
        $this->sectionTitle = 'New Address';
        $this->message = 'Address added successfully.';
        $this->showEditSection = true;
    }

    public function save()
    {
        $this->validate();
        if($this->user->addresses->count() == 0){
            $this->editing->main = 1;
        }
        $this->user->addresses()->save($this->editing);
        $this->user->refresh();
        $this->makeBlankEditing();
        $this->showEditSection = false;
        $this->dispatchBrowserEvent('alert-message', [
            'message' => $this->message
        ]);
    }

    public function edit($id){
        $address = $this->user->addresses->where('id',$id)->first();
        $this->states = $this->getStates($address->country_id);
        $this->editing = $address;
        $this->sectionTitle = 'Edit Address';
        $this->message = 'Address updated successfully.';
        $this->showEditSection = true;
    }

    public function remove($id)
    {
        $address = $this->user->addresses->find($id);
        $address->delete();
        $this->user->refresh();

        //Change the main address
        if($address->main == 1 && $this->user->addresses->count() > 0){
            $address = $this->user->addresses->sortByDesc('created_at')->first();
            $address->main = 1;
            $address->save();
        }
        $this->makeBlankEditing();
        $this->showEditSection = false;

        $this->dispatchBrowserEvent('alert-message', [
            'message' => 'Address removed successfully.'
        ]);
    }

    public function setMain($id)
    {
        foreach($this->user->addresses as $address)
        {
            $address->id == $id ? $address->main = 1 : $address->main = 0;
            $address->save();
        }

        $this->dispatchBrowserEvent('alert-message', [
            'message' => 'Address set as Main successfully.'
        ]);
    }

    public function updatedEditingCountryId($country_id)
    {
        $this->states = $this->getStates($country_id);
    }

    public function getStates($country_id)
    {
        return State::where('country_id', $country_id)->get();
    }

    public function render()
    {
        return view('livewire.addresses-section');
    }
}

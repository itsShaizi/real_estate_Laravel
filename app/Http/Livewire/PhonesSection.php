<?php

namespace App\Http\Livewire;

use App\Models\Phone;
use App\Models\User;
use Livewire\Component;

class PhonesSection extends Component
{
    public $user;
    public $editing;
    public $countries;
    public $message = '';
    public $sectionTitle = '';
    public $showEditSection = false;

    protected $rules = [
        'editing.phone_type' => 'required',
        'editing.number' => 'required|string|max:25',
        'editing.country_code' => 'required|string|max:2',
        'editing.country_code_num' => 'required|string|max:8',
        'editing.number_ext' => 'nullable|max:10',
        'editing.sort_order' => 'nullable',
    ];

    public function mount()
    {
        $this->makeBlankEditing();
    }

    public function makeBlankEditing()
    {
        $this->editing = new Phone;
    }

    public function newPhone()
    {
        $this->makeBlankEditing();
        $this->sectionTitle = 'New Phone';
        $this->message = 'Phone added successfully.';
        $this->showEditSection = true;
    }

    public function updatedEditingCountryCode()
    {
        if(!empty($this->editing->country_code)){
            $this->editing->country_code_num = $this->countries->where('iso2',$this->editing->country_code)->first()->phonecode;
        }
    }

    public function save()
    {
        $this->validate();
        if($this->user->phones->count() == 0){
            $this->editing->main = 1;
        }
        $this->user->phones()->save($this->editing);
        $this->user->refresh();
        $this->makeBlankEditing();
        $this->showEditSection = false;

        $this->dispatchBrowserEvent('alert-message', [
            'message' => $this->message
        ]);
    }

    public function edit($id){
        $this->editing = $this->user->phones->where('id',$id)->first();
        $this->sectionTitle = 'Edit Phone';
        $this->message = 'Phone updated successfully.';
        $this->showEditSection = true;
    }

    public function remove($id)
    {
        $phone = $this->user->phones()->find($id);
        $phone->delete();
        $this->user->refresh();

        //Change the main phone
        if($phone->main == 1  && $this->user->phones->count() > 0){
            $phone = $this->user->phones->sortByDesc('created_at')->first();
            $phone->main = 1;
            $phone->save();
        }
        $this->makeBlankEditing();
        $this->showEditSection = false;

        $this->dispatchBrowserEvent('alert-message', [
            'message' => 'Phone removed successfully.'
        ]);
    }

    public function setMain($id)
    {
        foreach($this->user->phones as $phone)
        {
            $phone->id == $id ? $phone->main = 1 : $phone->main = 0;
            $phone->save();
        }

        $this->dispatchBrowserEvent('alert-message', [
            'message' => 'Phone set as Main successfully.'
        ]);
    }

    public function render()
    {
        return view('livewire.phones-section');
    }
}

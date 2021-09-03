<?php

namespace App\Http\Livewire;

use App\Models\Email;
use Illuminate\Validation\Rule;
use Livewire\Component;

class EmailSection extends Component
{
    public $user;
    public $editing;
    public $message = '';
    public $sectionTitle = '';
    public $showEditSection = false;

    public function rules()
    {
        return [
            'editing.email' => [
                'required',
                'string',
                'email',
                Rule::unique('emails','email')->ignore($this->editing),
            ],
            'editing.email_type' => 'required|string',
            'editing.sort_order' => 'nullable',
        ];
    }

    public function mount()
    {
        $this->makeBlankEditing();
    }

    public function makeBlankEditing()
    {
        $this->editing = new Email;
    }

    public function new()
    {
        $this->makeBlankEditing();
        $this->sectionTitle = 'New Email';
        $this->message = 'Email added successfully.';
        $this->showEditSection = true;
    }

    public function save()
    {
        $this->validate();
        $this->user->emails()->save($this->editing);
        $this->user->refresh();
        $this->makeBlankEditing();
        $this->showEditSection = false;
        $this->dispatchBrowserEvent('alert-message', [
            'message' => $this->message
        ]);
    }

    public function edit($id)
    {
        $this->editing = $this->user->emails->where('id', $id)->first();
        $this->sectionTitle = 'Edit Email';
        $this->message = 'Email updated successfully.';
        $this->showEditSection = true;
    }

    public function remove($id)
    {
        $email = $this->user->emails()->find($id);
        if($this->user->email != $email->email){
            $email->delete();
            $this->user->refresh();

            //Change the main email
            if($email->main == 1  && $this->user->emails->count() > 0){
                $email = $this->user->emails->sortByDesc('created_at')->first();
                $email->main = 1;
                $email->save();
            }

            $this->makeBlankEditing();
            $this->showEditSection = false;

            $this->dispatchBrowserEvent('alert-message', [
                'message' => 'Email removed successfully.'
            ]);
        }else{
            $this->dispatchBrowserEvent('alert-error-message', [
                'message' => 'This email cannot be removed, change the main email first.',
            ]);
        }
    }

    public function setMain($id)
    {
        foreach ($this->user->emails as $email) {
            $email->id == $id ? $email->main = 1 : $email->main = 0;
            $email->save();
        }

        $this->dispatchBrowserEvent('alert-message', [
            'message' => 'Email set as Main successfully.'
        ]);
    }

    public function render()
    {
        return view('livewire.email-section');
    }
}

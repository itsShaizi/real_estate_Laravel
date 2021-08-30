<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class UserSearchComponent extends Component
{
    public $name = null;
    public $users = array();
    public $query = null;
    public $selected = null;
    public $highlightIndex = 0;

    protected $listeners = [
        'resetComponent'
    ];

    public function mount($value = null)
    {
        if ($value) {
            $user = User::find($value);

            $this->select($user);
        }
    }

    public function updatedQuery()
    {
        $this->reset('users', 'selected');

        $this->emitUp($this->name, $this->selected);

        if (strlen($this->query) > 0) {
            $this->users = User::query()
                ->select('id', 'first_name', 'last_name')
                ->where('first_name', 'like', '%' . $this->query . '%')
                ->orWhere('last_name', 'like', '%' . $this->query . '%')
                ->get();
        }
    }

    public function decrementHighlight()
    {
        if ($this->highlightIndex === 0) {
            $this->highlightIndex = count($this->users);

            return;
        }

        $this->highlightIndex--;
    }

    public function incrementHighlight()
    {
        if ($this->highlightIndex > count($this->users)) {
            $this->highlightIndex = 0;

            return;
        }

        $this->highlightIndex++;
    }

    public function selectWithEnter()
    {
        $user = $this->users[$this->highlightIndex] ?? null;

        if ($user) {
            $this->select($user);
        }
    }

    public function select(User $user)
    {
        $this->selected = $user->id;

        $this->query = "{$user->first_name} {$user->last_name}";

        $this->reset('users', 'highlightIndex');

        // Emit an event to the parent livewire component to get the user selected on this component
        // With that we can listen to this event and assing the value to the correspondent property
        $this->emitUp($this->name, $this->selected);

        $this->dispatchBrowserEvent('user-selected');
    }

    public function resetComponent()
    {
        $this->reset([
            'users',
            'query',
            'selected',
            'highlightIndex',
        ]);
    }

    public function render()
    {
        return view('livewire.user-search-component');
    }
}

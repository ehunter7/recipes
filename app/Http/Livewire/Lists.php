<?php

namespace App\Http\Livewire;

use App\Models\ItemList;
use App\Models\User;
use Livewire\Component;

class Lists extends Component
{
    public $user;
    public $lists;
    public $newListModal = false;

    public $team_id;

    protected $listeners = ["refreshLists"];

    public function mount()
    {
        $this->team_id = Auth()->user()->current_team_id;
        $this->lists = ItemList::where('team_id', $this->team_id)->get();
    }

    public function updatedNewListModal()
    {
        $this->emit('newListModal');
    }

    public function refreshLists()
    {
        $this->lists = ItemList::where('team_id', $this->team_id)->get();

    }


    public function render()
    {
        return view('livewire.lists');
    }
}
<?php

namespace App\Http\Livewire;

use App\Models\ItemList;
use Livewire\Component;

class StoreList extends Component
{
    public string $title;

    public bool $open;

    protected $rules = [
        'title' => 'required|min:3',
    ];

    protected $listeners = ['newListModal' => 'openNewList'];

    public function mount()
    {
        //
    }

    public function openNewList()
    {
        $this->open = true;
    }

    public function updatedTitle()
    {
        $this->validate();
    }

    public function createList()
    {
        $this->validate();

        ItemList::create([
            'name' => $this->title,
            'user_id' => Auth()->id(),
            'team_id' => Auth()->user()->current_team_id
        ]);

        $this->open = false;
    }

    public function render()
    {
        return view('livewire.store-list');
    }
}
<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Ingredient extends Component
{
    public $edit = false;
    public $item;

    public function editIngredient()
    {
        $this->emit('editIngredient', $this->item);
    }
    public function deleteIngredient()
    {
        $this->emit('deleteIngredient', $this->item);
    }

    public function render()
    {
        return view('livewire.ingredient');
    }
}
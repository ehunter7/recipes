<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Instruction extends Component
{
    public $edit = false;
    public $item;

    public function editInstruction()
    {
        $this->emit('editInstruction', $this->item);
    }
    public function deleteInstruction()
    {
        $this->emit('deleteInstruction', $this->item);
    }

    public function render()
    {
        return view('livewire.instruction');
    }
}
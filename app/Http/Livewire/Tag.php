<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Tag extends Component
{
    public $tag;

    public function mount($tag)
    {
        $this->tag = $tag;
    }
    
    public function render()
    {
        return view('livewire.tag');
    }
}
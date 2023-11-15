<?php

namespace App\Http\Livewire;

use App\Models\Recipe;
use App\Models\Team;
use Livewire\Component;

class Recipes extends Component
{

    public $recipes;

    public function mount()
    {
        $user = auth()->user();
        $this->recipes = Recipe::where('team_id', $user->current_team_id)->with(['comments'])->get();
        ray($this->recipes[0]);
    }

    public function render()
    {
        return view('livewire.recipes');
    }
}
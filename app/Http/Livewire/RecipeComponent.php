<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use App\Models\Recipe;

class RecipeComponent extends Component
{

    public Recipe $recipe;
    public User $user;

    public $isAdmin = false;
    public $tags;
    public $ingredients;
    public $instructions;
    public $chef;
    public $squad;
    public $comments;
    public $postComment;
    public $isFavorite;

    public function mount()
    {
        $this->user = User::find(Auth()->id());
        $this->isFavorite = $this->user->favorites()->where('recipe_id', $this->recipe->id)->exists();
        $this->tags = $this->recipe->tags()->get();
        $this->ingredients = $this->recipe->ingredients()->get();
        $this->instructions = $this->recipe->instructions()->get();
        $this->comments = $this->recipe->comments()->get();
        $this->chef = $this->recipe->user()->first();
        $this->isAdmin = Auth()->id() === $this->chef->id;
        $this->squad = $this->recipe->team()->first();
    }

    public function favorite()
    {
        if ($this->isFavorite) {
            $this->user->favorites()->where('recipe_id', $this->recipe->id)->delete();
            $this->isFavorite = false;
        } else {
            $this->user->favorites()->create([
                'recipe_id' => $this->recipe->id,
            ]);
            $this->isFavorite = true;
        }
    }

    public function storeComment()
    {
        $comment = $this->recipe->comments()->create([
            'content' => $this->postComment,
            'spam' => false,
            'user_id' => auth()->id(),
        ]);

        $this->comments = $this->recipe->comments()->get();
    }

    public function render()
    {
        return view('livewire.recipe-component')->layout('components.index');
    }
}
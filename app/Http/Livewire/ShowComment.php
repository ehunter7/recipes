<?php

namespace App\Http\Livewire;

use Illuminate\Support\Carbon;
use Livewire\Component;

class ShowComment extends Component
{
    public $comment;
    public $author;
    public $isAdmin;
    public $isAuthor;
    public $timeSince;

    public function mount($comment)
    {
        $this->comment = $comment;
        $this->author = $comment->user()->first();
        $recipeAuthorId = $this->comment->recipe()->first()->user_id;
        $this->isAdmin = $this->author->id === $recipeAuthorId;
        $this->isAuthor = $this->author->id === Auth()->id();
        $this->timeSince = Carbon::parse($comment->created_at)->diffForHumans();
    }
    public function render()
    {
        return view('livewire.show-comment');
    }
}
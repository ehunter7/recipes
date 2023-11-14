<?php

namespace App\Http\Livewire;

use App\Http\Controllers\RecipeController;
use App\Models\Recipe;
use App\Models\User;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class StoreRecipe extends Component
{
    use WithFileUploads;

    public $photo;
    public $name = '';
    public $category = '';
    public $yield = '';
    public $time = '';
    public $tags = [];
    public $newTag = '';
    public $description = '';
    public $ingredients = [];
    public $order = 1;
    public $amount = '';
    public $measurement = '';
    public $itemName = '';
    public $instructions = [];
    public $step = 1;
    public $instruction = '';

    protected $listeners = [
        'editIngredient',
        'deleteIngredient',
        'editInstruction',
        'deleteInstruction'
    ];

    public function mount()
    {
        //
    }

    public function addTag()
    {
        $this->newTag = trim($this->newTag);

        $this->validate(
            [
                'newTag' => 'required|min:2|max:12'
            ],
            [
                'newTag.min' => 'Min 2 characters',
                'newTag.max' => 'Max 12 characters',
                'newTag.required' => '',
            ],
        );

        $this->tags[] = ['label' => $this->newTag];

        $this->newTag = '';
    }

    public function addIngredient()
    {

        $this->validate(
            [
                'amount' => 'required',
                'measurement' => 'required',
                'itemName' => 'required',
            ],
            // [
            //     'amount.required' => '',
            //     'measurement.required' => '',
            //     'name.required' => '',
            // ],
        );

        $this->ingredients[$this->order] = [
            'order' => $this->order,
            'amount' => $this->amount,
            'measurement' => $this->measurement,
            'item' => $this->itemName
        ];
        $this->order++;
        $this->amount = '';
        $this->measurement = '';
        $this->itemName = '';
    }

    public function editIngredient($item)
    {
        $this->ingredients[$item['order']] = $item;
    }

    public function deleteIngredient($item)
    {
        unset($this->ingredients[$item['order']]);
    }

    public function addInstruction()
    {
        $this->instructions[$this->step] = [
            'step' => $this->step,
            'content' => $this->instruction
        ];

        $this->step++;
        $this->instruction = '';
    }

    public function editInstruction($item)
    {
        $this->instructions[$item['step']] = $item;
    }

    public function deleteInstruction($item)
    {
        unset($this->instructions[$item['step']]);
    }

    public function save()
    {
        $this->validate([
            // 1MB Max
            'photo' => 'image|max:1024',
            'name' => 'required|min:2|max:36',
            'category' => 'required|min:2|max:36',
            'yield' => 'required|integer',
            'time' => 'required|integer',
        ]);
        try {

            $user = User::where(['id' => auth()->id()])->first();
            $recipe = $user->recipes()->create([
                'name' => $this->name,
                'category' => $this->category,
                'photo' => '',
                'servings' => $this->yield,
                'time_minutes' => $this->time,
                'description' => $this->description,
                'junk' => false,
                'user_id' => $user->id,
                'team_id' => $user->current_team_id,
            ]);
            $token = str_replace(' ', '-', $this->name);
            $token .= '-' . $recipe->id;
            $this->photo->storeAs('photos', $token, 'recipe-images');
            $url = 'https://devrecipes.s3.us-west-1.amazonaws.com/recipe-images/photos/';
            $recipe->update(['photo' => $url . $token]);
            $ingredients = $recipe->ingredients()->createMany($this->ingredients);
            $instructions = $recipe->instructions()->createMany($this->instructions);
            $tags = $recipe->tags()->createMany($this->tags);
            return $this->redirect('/recipes');
        } catch (\Throwable $th) {
            Log::error($th);
            ray($th);
        }

    }

    public function render()
    {
        return view('livewire.store-recipe');
    }
}
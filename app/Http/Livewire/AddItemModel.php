<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\ItemList;
use Livewire\Component;

class AddItemModel extends Component
{
    public $newItem;
    public $categories = [];

    public $category = '';
    public $newCategory = '';
    public $categorySet = false;

    public $lists;
    public $list = '';
    public $newList = '';

    protected $rules = [
        'newItem' => 'required|min:3',
        'category' => 'required',
        'list' => 'required',
    ];

    public function mount()
    {
        $this->categories = Item::withTrashed()->orderBy('category', 'asc')->pluck('category')->unique()->all();
        $this->lists = ItemList::where('team_id', Auth()->user()->current_team_id)->get();
        ray($this->lists[0]);
    }

    public function updatedNewItem()
    {
        $this->validateOnly('newItem');
        $token = Item::where('name', 'LIKE', '%' .  $this->newItem . '%')->withTrashed()->orderBy('created_at', 'desc')->first();
        if(!$this->categorySet){
            $this->category = $token->category ?? 'misc';
        }
    }

    public function updatedCategory()
    {
        $this->validateOnly('category');

        if($this->category === ''){
            $this->categorySet = false;
            $token = Item::where('name', 'LIKE', '%' .  $this->newItem . '%')->withTrashed()->orderBy('created_at', 'desc')->first();

            if(!$this->categorySet){
                $this->category = $token->category ?? 'misc';
            }
        } else {
            $this->categorySet = true;
        }
    }

    public function addItem()
    {
        $this->validate();
        $listShuttle = ItemList::firstOrCreate([
            'name' => $this->list
        ],[
            'user_id' => Auth()->id(),
            'team_id' => Auth()->user()->current_team_id
        ]);
        Item::create([
            'name' => $this->newItem,
            'checked' => 0,
            'user_id' => Auth()->id(),
            'team_id' => Auth()->user()->current_team_id,
            'item_list_id' => $listShuttle->id,
            'category' => strtolower($this->category),
        ]);
        $this->newItem = '';
        $this->category = '';
        $this->list = '';
        $this->emit('item_added');
    }

    public function newCategory()
    {
        $this->category = $this->newCategory;
    }

    public function newList()
    {
        $this->list = $this->newList;
    }

    public function render()
    {
        return view('livewire.add-item-model');
    }
}

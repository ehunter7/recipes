<?php

namespace App\Http\Livewire;

use App\Models\Item;
use App\Models\ItemList;
use Livewire\Component;

class ShowList extends Component
{
    public ItemList $list;

    public $items;
    public $data;
    public $newItem = '';
    public bool $allChecked = false;
    public $category = '';
    public $categorySet = false;
    public $categories;

    protected $rules = [
        'newItem' => 'required|min:3',
    ];
    protected $listeners = ['item_added' => 'itemAdded'];

    public function mount()
    {
        $shuttle = Item::where('item_list_id', $this->list->id)->get();
        $this->items = $this->setData($shuttle);
        $this->categories = collect($this->items)->pluck('category')->unique();
        $this->checkIfAllChecked($shuttle);
    }

    public function checkIfAllChecked($shuttle)
    {
        $count = count($shuttle);
        $checkedCount = 0;
        foreach ($shuttle as $item) {
            if($item->checked){
                $checkedCount++;
                if ($count == $checkedCount) {
                    $this->allChecked = true;
                    return;
                }
            }
        }
        $this->allChecked = false;
    }

    public function itemAdded()
    {
        ray('yeah Buddy');
        $this->items = $this->setData(Item::where('item_list_id', $this->list->id)->get());
    }

    private function setData($data)
    {
        $this->data = $this->sortList($data);
        return $data;

    }

    public function sortList($items)
    {
        $grouped = $items->mapToGroups(function ($item, int $key) {
            return [$item->category => $item];
        });
        return $grouped;
    }

    public function addItem()
    {
        $this->validate();

        $token = $this->list->items()->create([
            'name' => $this->newItem,
            'checked' => 0,
            'user_id' => Auth()->id(),
            'team_id' => Auth()->user()->current_team_id,
            'item_list_id' => $this->list->id,
            'category' => strtolower($this->category),
        ]);
        $this->items[] = $token;

        $this->items = $this->setData($this->items);

        $this->newItem = '';
        $this->category = '';
    }

    public function checkItem( $itemId, $incomingCheckedStatus)
    {
        $checked = $incomingCheckedStatus ? 0 : 1;
        $item = Item::where('id', $itemId)->first();
        $item->update(['checked' => $checked]);
        $index = array_search($item['name'], $this->items->pluck('name')->toArray());
        $this->items[$index] = $item ;
        $this->checkIfAllChecked($this->items);
        $this->items = $this->setData($this->items);

    }

    public function checkAll($value)
    {
        $this->items->each(function ($item) use ($value){
            $item->update(['checked' => $value]);
        });
        $this->checkIfAllChecked($this->items);
        $this->items = $this->setData(Item::where('item_list_id', $this->list->id)->get());

    }

    public function updatedNewItem()
    {
        $this->validate();
        $this->categorySet = false;
        $token = Item::where('name', 'LIKE', '%' .  $this->newItem . '%')->withTrashed()->orderBy('created_at', 'desc')->first();
        if(!$this->categorySet){
            $this->category = $token->category ?? 'misc';
        }
    }

    public function updatedCategory()
    {
        if($this->category === '' && !$this->categorySet){
            $this->categorySet = false;
            $token = Item::where('name', 'LIKE', '%' .  $this->newItem . '%')->withTrashed()->orderBy('created_at', 'desc')->first();

            if(!$this->categorySet){
                $this->category = $token->category ?? 'misc';
            }
        } else {
            $this->categorySet = true;
        }
    }

    public function clearList()
    {
        $this->items->each(function ($item) {
            if($item->checked){
                $item->delete();
            }
        });
        $this->items = $this->setData(Item::where('item_list_id', $this->list->id)->get());
    }

    public function render()
    {
        return view('livewire.show-list')->layout('components.index');
    }
}

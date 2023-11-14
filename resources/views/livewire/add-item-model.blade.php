<div class="w-full md:w-[20%] mx-5 md:mr-5">
    <div class="mt-16 bg-white add-item-border dark:bg-gray-800 rounded-xl">
        <div class="px-6 py-2 pt-6 text-center">
            <h3 class="text-base font-semibold text-gray-800 dark:text-gray-200">
                Add an item
            </h3>
            <p class="mt-4 text-xs text-gray-800 dark:text-gray-200 whitespace-nowrap">
                Add an item to any of your list!
            </p>
        </div>
        <form wire:submit.prevent="addItem" class="px-4 py-6 space-y-4">
            <div>
                <x-input type="text" wire:model="newItem" placeholder="Your Idea" class="w-full text-sm" />
                @error('newItem')<span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="flex flex-row space-x-4 md:space-x-0 md:space-y-4 md:flex-col">
                <select wire:model="category" required
                    class="w-full px-4 py-2 text-sm text-gray-900 bg-gray-100 border border-gray-700 rounded-md invalid:text-gray-800 invalid:dark:text-gray-500 dark:text-gray-300 dark:bg-gray-900">
                    <option value="" selected>select a category</option>
                    @foreach ($categories as $cat)
                    <option value="{{$cat}}">{{$cat}}</option>
                    @endforeach
                </select>
                @error('category')<span class="error">{{ $message }}</span> @enderror
                <select wire:model="listId" required
                    class="w-full px-4 py-2 text-sm text-gray-900 bg-gray-100 border border-gray-700 rounded-md invalid:text-gray-800 invalid:dark:text-gray-500 dark:text-gray-300 dark:bg-gray-900">
                    <option value="" select>select a list</option>
                    @foreach ($lists as $list)
                    <option value="{{$list->id}}">{{$list->name}}</option>
                    @endforeach
                </select>
                @error('list')<span class="error">{{ $message }}</span> @enderror
            </div>
            <div>
                <div class="flex items-center justify-between space-x-3">

                    <button type="submit"
                        class="flex items-center justify-center w-full px-6 py-3 text-xs text-white transition duration-150 ease-in border h-11 bg-blue text-semibold rounded-xl border-blue hover:bg-blue">
                        <span class="ml-1 text-white">Add</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="space-y-4">
    <div class="text-gray-700 dark:text-gray-200">
        <h1>{{$list->name}}</h1>
        <div class="flex items-center justify-between mt-16">
            <p>{{$list->description}}</p>
            <section class="w-full sm:w-3/5">
                <div class="flex items-center justify-end space-x-2">
                    <div class="input-with-placeholder">
                        <x-input id="item" name="item" type="text" wire:model="newItem" wire:keydown.enter="addItem"
                            class="w-1/3" required />
                        <x-label for="item">Item Name</x-label>
                    </div>
                    <div class="input-with-placeholder">
                        <x-input id="category" name="category" type="text" wire:model="category"
                            wire:keydown.enter="addItem" class="w-1/3" required />
                        <x-label for="category">Category</x-label>
                    </div>
                    <svg wire:click="addItem" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                        stroke-width="1.5" stroke="currentColor" class="w-8 h-8 text-gray-400">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                @error('newItem')<p class="error">{{ $message }}</p> @enderror
            </section>

        </div>
    </div>
    <hr>
    <div>
        <div class="flex flex-nowrap">
            <x-button wire:click="checkAll(1)">check all</x-button>
            <x-button wire:click="checkAll(0)">Uncheck all</x-button>
            <x-button wire:click="clearList()">clear checked</x-button>
        </div>
        <div class="space-y-2">
            @foreach ($data as $key => $group)
            @php
            if($key === ''){
            $groupName = 'Misc';
            } else {
            $groupName = $key;
            };
            @endphp
            <h2 class="text-lg font-semibold tracking-wide text-gray-700 dark:text-gray-200">{{$groupName}}</h2>
            @foreach($group as $item)
            <div x-data="{checked: {{ $item['checked'] }} }">
                <div x-bind:class="{'opacity-25': {{$item['checked']}}}"
                    class="relative flex items-center justify-between pl-6 ml-6 space-x-6 transition-opacity duration-300 dark:bg-gray-700">
                    <div x-data="{open: false}" class="flex items-center w-full space-x-2">
                        <x-label x-cloak x-show="!open" x-on:click="{{$item['checked']}} ? '' : open = !open"
                            for="item-{{$item['id']}}" class="text-gray-700 dark:text-gray-200 hover:cursor-pointer">
                            {{$item['name']}}
                        </x-label>
                        <x-input x-cloak x-show="open" value="{{$item['name']}}" type="text"
                            class="h-8 !-ml-[0.75rem]" />
                        <x-input x-cloak x-show="open" value="{{$item['category']}}" type="text" class="h-8" />
                        <svg x-cloak x-show="open" @click="open = !open" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 text-gray-400">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />
                        </svg>

                    </div>

                    <div wire:click="checkItem({{$item['id']}}, {{$item['checked']}})" id="item-{{$item['id']}}"
                        class="w-1/2 h-8 transition-all duration-300 hover:cursor-pointer">
                        <hr x-bind:class="{{$item['checked']}} === 1 ? 'w-full top-4' : 'w-10 top-3'"
                            class="absolute right-0 transition-all duration-300" />
                        <hr x-bind:class="{{$item['checked']}} === 1 ? 'w-full top-4' : 'w-10 top-5'"
                            class="absolute right-0 text-black transition-all duration-300 bg-gray-700" />
                    </div>
                </div>
            </div>
            @endforeach
            @endforeach

        </div>
    </div>
</div>
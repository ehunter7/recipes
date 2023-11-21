<div class="space-y-4">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __($list->name) }}
        </h2>
    </x-slot>
    <div class="text-gray-700 dark:text-gray-200">
        <div class="flex items-center justify-between mt-16">
            <p>{{$list->description}}</p>
            <section class="w-full sm:w-3/5">
                <div class="flex items-center justify-end space-x-2">
                    <div class="input-with-placeholder">
                        <x-input id="item" name="item" type="text" wire:model.debounce.400ms="newItem"
                            wire:keydown.enter="addItem" class="w-1/3" required />
                        <x-label for="item">Item Name</x-label>
                    </div>
                    <div class="flex justify-center">
                        <div x-data="{
                                open: false,
                                require: true,
                                toggle() {
                                    if (this.open) {
                                        return this.close()
                                    }
                                    this.$refs.button.focus()
                                    this.open = true
                                },
                                close(focusAfter) {
                                    if (! this.open) return
                                    this.open = false
                                    focusAfter && focusAfter.focus()
                                }
                            }" x-on:keydown.escape.prevent.stop="close($refs.button)"
                            x-on:focusin.window="! $refs.panel.contains($event.target) && close()"
                            x-id="['dropdown-button']" class="relative">
                            <!-- Trigger -->
                            <div class="input-with-placeholder">
                                <x-input x-ref="button" x-on:click="toggle()" id="category" name="category" type="text"
                                    wire:model="category" wire:keydown.enter="addItem" class="w-1/3" required />
                                <x-label for="category">Category</x-label>
                            </div>
                            <!-- Panel -->
                            <div x-ref="panel" x-show="open" x-transition.origin.top.left
                                x-on:click.outside="close($refs.button)" :id="$id('dropdown-button')"
                                style="display: none;"
                                class="absolute left-0 z-10 w-40 mt-2 bg-white rounded-md shadow-xl dark:bg-gray-800">
                                @foreach ($categories as $category)
                                <div wire:click="$set('category', '{{$category}}')" @click="open = !open"
                                    class="flex items-center gap-2 w-full first-of-type:rounded-t-md last-of-type:rounded-b-md px-4 py-2.5 text-left text-sm hover:bg-gray-50 disabled:text-gray-500 dark:hover:bg-gray-500">
                                    {{$category}}
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <x-add-icon class="w-8 h-8 text-gray-400 hover:cursor-pointer" />
                </div>
                @error('newItem')<p class="error">{{ $message }}</p> @enderror
            </section>
        </div>
    </div>
    <hr>
    <div>
        <div class="flex justify-end space-x-4 flex-nowrap">
            @if ($allChecked)
            <x-button wire:click="checkAll(0)">Uncheck all</x-button>
            @else
            <x-button wire:click="checkAll(1)">check all</x-button>
            @endif
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
                        <x-confirm-icon x-cloak x-show="open" @click="open = !open" class="w-6 h-6 text-gray-400" />

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
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
                <x-input type="text" wire:model="newItem" placeholder="Your Item" class="w-full text-sm" />
                @error('newItem')<span class="error">{{ $message }}</span> @enderror
            </div>
            <div x-data="{categoryError: false, listError: false}"
                class="flex flex-row space-x-4 md:space-x-0 md:space-y-4 md:flex-col">
                {{-- category --}}
                <x-dropdown align="left" width="48">
                    <x-slot name="trigger">
                        <span class="inline-flex w-full rounded-md">
                            <button type="button"
                                class="flex items-center justify-between w-full px-4 py-2 text-sm text-gray-900 bg-gray-100 border border-gray-700 rounded-md invalid:text-gray-800 invalid:dark:text-gray-500 dark:text-gray-300 dark:bg-gray-900">

                                @if ($category === '')
                                <span class="text-gray-500 "> Select a category</span>
                                @else
                                <span>{{$category}}</span>
                                @endif
                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                            @error('category')<span class="error">{{ $message }}</span> @enderror
                        </span>
                    </x-slot>
                    <x-slot name="content">
                        <ul>
                            @foreach ($categories as $cat)
                            <li>
                                <x-dropdown-link wire:click="$set('category', '{{$cat}}')">
                                    {{$cat}}
                                </x-dropdown-link>
                            </li>
                            @endforeach
                        </ul>
                        <div class="border-t border-gray-200 dark:border-gray-600"></div>
                        <!-- Add Category -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('New Category') }}
                        </div>
                        <div class="px-1">
                            <div class="flex items-center justify-between">
                                <x-input wire:click.stop="" wire:keydown.enter.prevent="" type="text"
                                    wire:model="newCategory" class="w-4/5 text-sm " />
                                @if ($newCategory !== '')
                                <svg wire:click="newCategory" wire:key="new" @click="categoryError = false"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-8 h-8 text-gray-400 hover:cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                @else
                                <svg wire:click.stop="" @click="categoryError = true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-8 h-8 text-gray-500 hover:cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                @endif
                            </div>
                            <span x-cloak x-show="categoryError" class="pl-2 text-sm italic text-red"> Category is
                                required</span>
                        </div>
                    </x-slot>
                </x-dropdown>
                @error('list')<span class="error">{{ $message }}</span> @enderror
                {{-- lists --}}
                <x-dropdown align="left" width="48">
                    <x-slot name="trigger">
                        <span class="inline-flex w-full rounded-md">
                            <button type="button"
                                class="flex items-center justify-between w-full px-4 py-2 text-sm text-gray-900 bg-gray-100 border border-gray-700 rounded-md invalid:text-gray-800 invalid:dark:text-gray-500 dark:text-gray-300 dark:bg-gray-900">

                                @if ($list === '')
                                <span class="text-gray-500 "> Select a list</span>
                                @else
                                <span>{{$list}}</span>
                                @endif
                                <svg class="ml-2 -mr-0.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none"
                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                                </svg>
                            </button>
                            @error('list')<span class="error">{{ $message }}</span> @enderror
                        </span>
                    </x-slot>
                    <x-slot name="content">
                        <ul>
                            @foreach ($lists as $mList)
                            <li>
                                <x-dropdown-link wire:click="$set('list', '{{$mList['name']}}')">
                                    {{$mList['name']}}
                                </x-dropdown-link>
                            </li>
                            @endforeach
                        </ul>
                        <div class="border-t border-gray-200 dark:border-gray-600"></div>
                        <!-- Add list -->
                        <div class="block px-4 py-2 text-xs text-gray-400">
                            {{ __('New List') }}
                        </div>
                        <div class="px-1">
                            <div class="flex items-center justify-between">
                                <x-input wire:click.stop="" wire:keydown.enter.prevent="" type="text"
                                    wire:model="newList" class="w-4/5 text-sm " />
                                @if ($newList !== '')
                                <svg wire:click="newList" wire:key="new" @click="listError = false"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-8 h-8 text-gray-400 hover:cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                @else
                                <svg wire:click.stop="" @click="listError = true" xmlns="http://www.w3.org/2000/svg"
                                    fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-8 h-8 text-gray-500 hover:cursor-pointer">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 9v6m3-3H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                @endif
                            </div>
                            <span x-cloak x-show="listError" class="pl-2 text-sm italic text-red"> List is
                                required</span>
                        </div>
                    </x-slot>
                </x-dropdown>
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
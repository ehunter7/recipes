<div class="flex mt-4 bg-gray-200 dark:bg-gray-800 dark:border-gray-500 idea-container rounded-xl">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('New Recipe') }}
        </h2>
    </x-slot>
    <form wire:submit.prevent="save" class="flex flex-col flex-1 px-4 py-6">
        <div class="flex items-center justify-center w-full">
            @if ($photo)
            <div class="w-full h-64 ">
                <img class="object-cover object-center w-full h-full rounded-xl" src="{{$photo->temporaryUrl()}}"
                    alt="photo">
            </div>
            @else
            <label for="dropzone-file"
                class="flex flex-col items-center justify-center w-full h-64 bg-gray-200 border-2 border-gray-200 border-dashed rounded-lg cursor-pointer dark:hover:bg-gray-900 dark:bg-gray-800 hover:bg-gray-100 dark:border-gray-500 dark:hover:border-gray-500 ">
                <div class="flex flex-col items-center justify-center pt-5 pb-6">
                    <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2" />
                    </svg>
                    <p class="mb-2 text-sm text-gray-500 dark:text-gray-200"><span
                            class="font-semibold dark:text-gray-200">Click to
                            upload</span> or drag and drop</p>
                    <p class="text-xs text-gray-500 dark:text-gray-400">SVG, PNG, JPG or GIF (MAX. 800x400px)</p>
                </div>
                <input id="dropzone-file" wire:model="photo" type="file" class="hidden" />
                @error('photo') <span class="error">{{ $message }}</span> @enderror
            </label>
            @endif
        </div>


        <div class="w-full mt-6 space-y-6">
            <div>
                <label for="name" class="text-lg font-semibold text-gray-700 dark:text-gray-200">Name</label>
                <x-input id="name" type="text" wire:model="name" class="w-full mt-3 border-none d rounded-xl" />
            </div>
            <div class="flex space-x-2">
                <div class="flex flex-col justify-between w-1/2 space-y-3 rounded-xl">
                    <div>
                        <label for="yield"
                            class="text-lg font-semibold text-gray-700 dark:text-gray-200">category</label>
                        <x-input id="yield" type="text" wire:model="category"
                            class="w-full mt-3 border-none rounded-xl" />
                    </div>
                    <div>
                        <label for="yield" class="text-lg font-semibold text-gray-700 dark:text-gray-200">Yield</label>
                        <x-input id="yield" type="text" wire:model="yield" class="w-full mt-3 border-none rounded-xl" />
                    </div>
                    <div>
                        <label for="time" class="text-lg font-semibold text-gray-700 dark:text-gray-200">Time</label>
                        <x-input id="time" type="text" wire:model="time" class="w-full mt-3 border-none rounded-xl" />
                    </div>
                </div>

                <div class="w-1/2 p-2 overflow-y-auto bg-white dark:bg-gray-900 rounded-xl">
                    <div class="flex justify-between">
                        <p class="text-lg font-semibold text-gray-700 dark:text-gray-200">Tags</p>


                        <div class="flex space-x-2">
                            <input type="text" wire:model="newTag" wire:keydown.enter.prevent="addTag()"
                                class="h-8 border-none rounded-xl dark:bg-gray-800 dark:text-gray-200">
                            <div wire:click.prevent="addTag()"
                                class="flex items-center justify-center h-8 p-1 bg-gray-200 rounded-full dark:bg-gray-800 hover:cursor-pointer">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor"
                                    class="w-6 h-6 text-gray-700 dark:text-gray-200">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    @error('newTag') <div class="ml-24 text-xs italic text-white">{{ $message }}</div> @enderror

                    <div class="flex flex-wrap mt-2 ">
                        @foreach ($tags as $tag)
                        @livewire('tag', ['tag' => $tag], key($tag['label']))
                        @endforeach
                    </div>
                </div>

            </div>
            <div>
                <label for="description"
                    class="block text-lg font-semibold text-gray-700 dark:text-gray-200">Description</label>
                <textarea id="description" rows="3" wire:model="description"
                    class="w-full mt-3 text-gray-700 border-none dark:bg-gray-900 rounded-xl dark:text-gray-200">
                    </textarea>
            </div>
            <div>
                <label for="ingredients"
                    class="block text-lg font-semibold text-gray-700 dark:text-gray-200">Ingredients</label>
                @foreach ($ingredients as $ingredient)
                @livewire('ingredient', ['item' => $ingredient], key($ingredient['order'] . '-' . $ingredient['item']))
                @endforeach
                {{-- New ingredient input --}}
                <div class="flex space-x-2">
                    <div class="w-1/6">
                        <label for="amount" class="block text-gray-700 dark:text-gray-200">Amount</label>
                        <x-input id="amount" wire:model="amount" wire:keydown.enter.prevent="addIngredient"
                            name="amount" type="number" class="w-full text-lg border-none rounded-xl" />
                    </div>
                    <div class="w-2/6">
                        <label for="measurement" class="block text-gray-700 dark:text-gray-200">Measurement</label>
                        <x-input id="measurement" wire:model="measurement" wire:keydown.enter.prevent="addIngredient"
                            name="measurement" type="text" class="w-full text-lg border-none rounded-xl" />
                    </div>
                    <div class="w-3/6">
                        <label for="itemName" class="block text-gray-700 dark:text-gray-200">Item</label>
                        <x-input id="itemName" wire:model="itemName" wire:keydown.enter.prevent="addIngredient"
                            name="itemName" type="text" class="w-full text-lg border-none rounded-xl" />
                    </div>
                    <div class="flex items-center pt-5 pl-3">
                        <button type="button" wire:click="addIngredient"
                            class="flex items-center justify-center h-8 p-1 bg-gray-200 rounded-full dark:bg-gray-900 hover:cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 text-gray-700 dark:text-gray-200">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
            <div>
                <label for="instructions"
                    class="block text-lg font-semibold text-gray-700 dark:text-gray-200">Instructions</label>
                @foreach ($instructions as $instruction)
                @livewire('instruction', ['item' => $instruction], key($instruction['step'] . '-' .
                $instruction['content']))
                @endforeach
                <div class="mt-3">
                    <div class="flex justify-between">
                        <label for="step" class="block text-gray-700 dark:text-gray-200">Step Insturctions</label>
                        <button type="button" wire:click.prevent="addInstruction"
                            class="flex items-center justify-center h-8 p-1 bg-gray-200 rounded-full dark:bg-gray-900 hover:cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="w-6 h-6 text-gray-700 dark:text-gray-200">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m6-6H6" />
                            </svg>
                        </button>
                    </div>
                    <textarea id="description" rows="3" wire:model="instruction"
                        class="w-full mt-3 text-gray-700 border-none dark:bg-gray-900 rounded-xl dark:text-gray-200">
                        </textarea>
                </div>
            </div>
            <div class="flex justify-end w-full">
                <x-button class="justify-center w-32 rounded-xl">Save</x-button>
            </div>
        </div>
    </form>
</div> <!-- End of idea-container -->
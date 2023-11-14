<div x-data="{open: @entangle('open')}">
    <!-- Modal -->
    <div x-show="open" style="display: none" x-on:keydown.escape.prevent.stop="open = false" role="dialog"
        aria-modal="true" x-id="['modal-title']" :aria-labelledby="$id('modal-title')"
        class="fixed inset-0 z-10 overflow-y-auto">
        <!-- Overlay -->
        <div x-show="open" x-transition.opacity class="fixed inset-0 bg-black bg-opacity-50"></div>
        <!-- Panel -->
        <div x-show="open" x-transition x-on:click="open = false"
            class="relative flex items-center justify-center min-h-screen p-4">
            <div x-on:click.stop x-trap.noscroll.inert="open"
                class="relative w-full max-w-2xl overflow-y-auto bg-white shadow-lg add-item-border dark:bg-gray-800 rounded-xl ">
                <div class="p-12">
                    <!-- Title -->
                    <h2 class="text-3xl font-bold dark:text-gray-200" :id="$id('modal-title')">New List</h2>
                    <!-- Content -->
                    <p class="mt-2 text-gray-600 dark:text-gray-300">Enter the name of the new list.</p>
                    <x-input wire:model="title" id="title" name="title" type="text" class="w-full"
                        placeholder="List Name" />
                    @error('title')<span class="error">{{ $message }}</span> @enderror

                    <!-- Buttons -->
                    <div class="flex mt-8 space-x-2">
                        <button type="button" wire:click="createList"
                            class="flex items-center justify-center px-6 py-3 text-xs text-white transition duration-150 ease-in border h-11 bg-blue text-semibold rounded-xl border-blue hover:bg-blue">
                            Confirm
                        </button>
                        <button type="button" x-on:click="open = false"
                            class="flex items-center justify-center px-6 py-3 text-xs text-white transition duration-150 ease-in border h-11 bg-[#B33A3A] text-semibold rounded-xl border-[#780000] hover:bg-[#780000]">
                            Cancel
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
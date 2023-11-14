<div x-data="{open: {{$open}}}">
    <h1 class="text-white">{{$open}}</h1>
    <span class="text-green" x-text="open"></span>
    {{ $trigger }}
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
                {{ $slot }}
            </div>
        </div>
    </div>
</div>
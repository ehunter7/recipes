<x-form-section submit="createTeam">
    <x-slot name="title">
        {{ __('Squad Details') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Create a new Squad to collaborate with others on recipes.') }}
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6">
            <x-label value="{{ __('Squad Owner') }}" />

            <div class="flex items-center mt-2">
                <img class="object-cover w-12 h-12 rounded-full" src="{{ $this->user->profile_photo_url }}"
                    alt="{{ $this->user->name }}">

                <div class="ml-4 leading-tight">
                    <div class="text-gray-900 dark:text-white">{{ $this->user->name }}</div>
                    <div class="text-sm text-gray-700 dark:text-gray-300">{{ $this->user->email }}</div>
                </div>
            </div>
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('Squad Name') }}" />
            <x-input id="name" type="text" class="block w-full mt-1" wire:model.defer="state.name" autofocus />
            <x-input-error for="name" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-button>
            {{ __('Create') }}
        </x-button>
    </x-slot>
</x-form-section>
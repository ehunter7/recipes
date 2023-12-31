<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100 dark:bg-gray-900">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
        <header class="bg-white shadow dark:bg-gray-800">
            <div class="px-4 py-6 mx-auto max-w-7xl sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
        @endif

        {{-- Page Content --}}
        <main class="container flex flex-wrap mx-auto max-w-custom">
            {{-- add item --}}
            @livewire('add-item-model')
            {{-- lists list --}}
            <div class="w-full mx-5 md:w-175">
                {{-- <nav class="flex items-center justify-between text-xs">
                    <ul class="flex pb-3 space-x-10 font-semibold uppercase border-b-4">
                        <li>
                            <a href="#" class="pb-3 border-b-4 border-blue">
                                All Ideas (87)
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="pb-3 transition duration-150 ease-in border-b-4 test-gray-400 hover:border-blue">
                                Considering (6)
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="pb-3 transition duration-150 ease-in border-b-4 test-gray-400 hover:border-blue">
                                In Progress (1)
                            </a>
                        </li>
                    </ul>
                    <ul class="flex pb-3 space-x-10 font-semibold uppercase border-b-4">
                        <li>
                            <a href="#"
                                class="pb-3 transition duration-150 ease-in border-b-4 test-gray-400 hover:border-blue">
                                Implemented (10)
                            </a>
                        </li>
                        <li>
                            <a href="#"
                                class="pb-3 transition duration-150 ease-in border-b-4 test-gray-400 hover:border-blue">
                                Closed (55)
                            </a>
                        </li>
                    </ul>
                </nav> --}}
                <div class="mt-16">
                    {{$slot}}
                </div>
            </div>
        </main>
        {{-- <main>
            {{ $slot }}
        </main> --}}
    </div>
    @livewire('footer')

    @stack('modals')

    @livewireScripts
</body>

</html>
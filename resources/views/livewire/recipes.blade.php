<div class="my-6 space-y-6 ideas-container dark:bg-gray-900">
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            {{ __('Recipes') }}
        </h2>
    </x-slot>
    <div class="flex space-x-6 filters">
        {{-- <div class="w-1/3">
            <select name="category" id="category "
                class="w-full px-4 py-2 text-gray-700 bg-white border-none rounded-xl dark:bg-gray-800 dark:text-gray-200">
                <option value="Category One">Category One</option>
                <option value="Category Two">Category Two</option>
                <option value="Category Three">Category Three</option>
                <option value="Category Four">Category Four</option>
            </select>
        </div>
        <div class="w-1/3">
            <select name="other_filters" id="other_filters "
                class="w-full px-4 py-2 text-gray-700 bg-white border-none rounded-xl dark:bg-gray-800 dark:text-gray-200">
                <option value="Filter One">Filter One</option>
                <option value="Filter Two">Filter Two</option>
                <option value="Filter Three">Filter Three</option>
                <option value="Filter Four">Filter Four</option>
            </select>
        </div> --}}
        <div class="relative w-2/3">

            <input type="search" placeholder="Find a recipe"
                class="w-full px-4 py-2 pl-8 bg-white border-none dark:bg-gray-800 placeholder:text-gray-700 dark:placeholder:text-gray-200 rounded-xl">
            <div class="absolute top-0 flex items-center h-full ml-2">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="w-4 text-gray-700 dark:text-gray-200">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M21 21l-5.197-5.197m0 0A7.5 7.5 0 105.196 5.196a7.5 7.5 0 0010.607 10.607z" />
                </svg>
            </div>
        </div>
    </div>
    @foreach ($recipes as $recipe)
    <div
        class="flex transition duration-150 ease-in bg-white cursor-pointer dark:bg-gray-700 idea-container hover:shadow-md rounded-xl">
        {{-- <div class="px-5 py-4 border-r border-gray-100">
            <div class="text-center">
                <div class="text-2xl font-semibold">12</div>
                <div class="text-gray-500">Votes</div>
            </div>
            <div class="mt-8">
                <button
                    class="w-20 px-4 py-3 text-xs font-bold uppercase transition duration-150 ease-in bg-gray-200 border border-gray-200 hover:border-gray-400 rounded-xl">Vote</button>
            </div>
        </div> --}}
        <a href="/recipes/{{$recipe->id}}" class="">
            <div class="flex-none overflow-hidden">
                <img src="{{$recipe->photo}}" alt="recipe photo"
                    class="object-cover object-center w-48 rounded-tl-xl rounded-bl-xl">
            </div>
            <div class="flex items-center flex-1 px-2 py-6">
                <div class="w-full mx-4">
                    <h4 class="text-xl font-semibold text-gray-700 hover:underline dark:text-gray-200">{{$recipe->name}}
                    </h4>
                    <div class="mt-3 text-gray-600 dark:text-gray-200 line-clamp-2 ">{{$recipe->description}}
                    </div>
                    <div class="items-center justify-between flex-none mt-6 space-y-4 md:space-y-0 md:flex">
                        <div class="items-center flex-none space-x-1 text-xs font-semibold text-gray-400 md:flex">
                            <div>Cook Time: {{$recipe->time_minutes}} minutes</div>
                            {{-- <div>&bull;</div>
                            <div>Nates Favorite</div> --}}
                            <div class="hidden md:block">&bull;</div>
                            <div class="text-gray-900 dark:text-white">{{$recipe->comments->count()}}
                                {{$recipe->comments->count() > 1 ? 'comments' : 'comment'}}</div>
                        </div>
                        <div x-data="{isOpen: false}" class="flex items-center space-x-2">
                            <div
                                class="px-2 py-1 text-xs font-bold leading-none text-center uppercase bg-gray-200 rounded-full">
                                {{$recipe->category}}</div>
                            <button @click.stop="isOpen = !isOpen"
                                class="relative px-3 py-2 transition duration-150 ease-in bg-gray-100 border rounded-full hover:bg-gray-200 h-7 dark:bg-gray-700">
                                <svg fill="currentColor" width="24" height="6">
                                    <path
                                        d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z"
                                        style="color: rgba(163, 163, 163, .5)">
                                </svg>
                                <ul x-cloak x-show="isOpen" @click.away="isOpen = false"
                                    @keydown.escape.window="isOpen = false" x-transition.origin.top.left
                                    class="absolute w-40 py-3 font-semibold text-left bg-white shadow-xl rounded-xl ">
                                    <li><a href="#"
                                            class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">Mark
                                            as
                                            junk</a>
                                    </li>
                                    {{-- <li><a href="#"
                                            class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100">Delete
                                            Post</a>
                                    </li> --}}
                                </ul>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    </div> <!-- End of idea container -->
    @endforeach
</div> <!--  End of ideas container-->
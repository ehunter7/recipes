<div>
    <div class="flex mt-4 bg-gray-200 dark:bg-gray-800 dark:border-gray-500 idea-container rounded-xl">
        <div class="flex flex-col flex-1 px-4 py-6">
            <div class="flex flex-none space-x-2">
                <a class="w-full h-96">
                    <img src="{{$recipe->photo}}" alt="recipe photo"
                        class="object-cover object-center w-full h-full rounded-xl">
                </a>
            </div>
            <div class="w-full mt-6 space-y-6">
                <div x-data="{editName: false}" class="flex justify-between">
                    <h1 class="flex text-xl font-semibold text-gray-700 dark:text-gray-200" @mouseover="editName = true"
                        @mouseout="editName = false">
                        {{$recipe->name}}
                        <div x-cloak x-show="editName" class="ml-6">
                            <x-edit-icon class="w-6 h-6" />
                        </div>
                    </h1>
                    <button wire:click.prevent="favorite" class="p-2 bg-gray-700 rounded-full dark:bg-gray-700">
                        @if ($isFavorite)
                        <x-star-icon class="w-6 h-6 text-[#FFD700]" fill="#FFD700" />
                        @else
                        <x-star-icon class="w-6 h-6 text-gray-700 dark:text-gray-200" fill="none" />
                        @endif
                        <span class="sr-only">Favorite</span>
                    </button>
                </div>
                <div class="flex space-x-2">
                    <div
                        class="flex flex-col justify-between w-1/2 p-4 text-gray-700 bg-white dark:bg-gray-900 rounded-xl dark:text-gray-200">
                        <p class="mb-3"><span class="font-semibold">By: {{$chef->name}}</span></p>
                        <p><span class="font-semibold">Yeild: {{$recipe->servings}}</span></p>
                        <p><span class="font-semibold">Rating</span></p>
                        <p><span class="font-semibold">Time: {{$recipe->time_minutes}}</span></p>
                    </div>
                    <div class="w-1/2 p-4 text-gray-700 bg-white dark:bg-gray-900 rounded-xl dark:text-gray-200">
                        <p><span class="font-semibold">Tags</span></p>
                        <div class="flex flex-wrap h-24 overflow-y-auto rounded-xl">
                            @foreach ($tags as $tag)
                            <div
                                class="px-2 py-1 m-1 text-gray-700 rounded-xl bg-gra-200 dark:bg-gray-700 dark:text-gray-200 h-fit">
                                <p class="text-white">{{$tag->label}}</p>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div>
                    <h4 class="text-xl font-semibold">
                        <a href="#" class="text-gray-700 dark:text-gray-200">Description</a>
                    </h4>
                    <div class="mt-3 text-gray-700 dark:text-gray-200">{{$recipe->description}}
                    </div>
                </div>
                <div>
                    <h4 class="text-xl font-semibold">
                        <a href="#" class="text-gray-700 hover:underline dark:text-gray-200">Ingredients</a>
                    </h4>
                    @foreach ($ingredients as $ingredient)
                    <div class="flex mt-3 space-x-2 text-gray-700 dark:text-gray-200">
                        <p>{{$ingredient->amount}}</p>
                        <p>{{$ingredient->Measurement}}</p>
                        <p>{{$ingredient->item}}</p>
                    </div>
                    @endforeach
                </div>
                <div>
                    <h4 class="text-xl font-semibold">
                        <a href="#" class="text-gray-700 hover:underline dark:text-gray-200">Instructions</a>
                    </h4>
                    @foreach ($instructions as $instruction)
                    <div class="mt-3 text-gray-700 dark:text-gray-200">

                        <p>{{$instruction->content}}</p>

                    </div>
                    @endforeach
                </div>
                <div class="flex items-center justify-between mt-6">
                    <div class="flex items-center space-x-2 text-xs font-semibold text-gray-400">
                        <div class="font-bold text-gray-900 dark:text-white">{{$brigade->name}}</div>

                        <div>&bull;</div>
                        <div>Nate's Favorite</div>
                        <div>&bull;</div>
                        <div class="text-gray-900 dark:text-white">{{$comments->count()}} Comments</div>
                    </div>
                    <div x-data="{isOpen: false, isAdmin: @entangle('isAdmin')}" class="flex items-center space-x-2">
                        <div
                            class="px-4 py-2 text-xs font-bold leading-none text-center text-gray-700 uppercase bg-gray-200 rounded-full dark:bg-gray-900 dark:text-gray-200 w-28 h-7">
                            Dinner</div>
                        <button x-cloak x-show="isAdmin" @click="isOpen = !isOpen" :disabled="{{!$isAdmin}}"
                            class="relative px-3 py-2 transition duration-150 ease-in bg-gray-100 border rounded-full dark:bg-gray-800 hover:bg-gray-200 h-7">
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
    </div> <!-- End of idea-container -->

    <div class="flex items-center justify-between mt-6 buttons-container">
        <div class="flex items-center ml-6 space-x-4">
            <div x-data="{isOpen: false}" class="relative">
                <button @click="isOpen = !isOpen" type="button"
                    class="flex items-center justify-center w-32 px-6 py-3 text-sm text-white transition duration-150 ease-in border h-11 bg-blue text-semibold rounded-xl border-blue hover:bg-blue-hover">
                    Reply
                </button>
                <div x-cloak x-show="isOpen" @click.away="isOpen = false" @keydown.escape.window="isOpen = false"
                    x-transition.origin.top.left
                    class="absolute z-10 mt-2 text-sm font-semibold text-left bg-white shadow-lg w-104 rounded-xl">
                    <div class="px-4 py-6 space-y-4">
                        <div>
                            <textarea wire:model="postComment" cols="30" rows="4"
                                class="w-full px-4 py-2 text-sm placeholder-gray-900 bg-gray-100 border-none rounded-xl"
                                placeholder="Go ahead, don't be shy. Share your thoughts..."></textarea>
                        </div>
                        <div class="flex items-center space-x-3">
                            <button type="button" wire:click.prevent="storeComment" @click="isOpen = false"
                                class="flex items-center justify-center w-1/2 px-6 py-3 text-sm text-white transition duration-150 ease-in border h-11 bg-blue text-semibold rounded-xl border-blue hover:bg-blue-hover">
                                Post Comment
                            </button>
                            <button type="button"
                                class="flex items-center justify-center w-32 px-6 py-3 text-xs transition duration-150 ease-in bg-gray-200 border border-gray-200 h-11 text-semibold rounded-xl hover:border-gray-400">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-4 h-4 text-gray-500 transform -rotate-45">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13" />
                                </svg>
                                <span class="ml-1">Attach</span>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div x-data="{isOpen: false}" class="relative">
                <button @click="isOpen = !isOpen" type="button"
                    class="flex items-center justify-center px-6 py-3 text-sm transition duration-150 ease-in bg-gray-200 border border-gray-200 w-36 h-11 text-semibold rounded-xl hover:border-gray-400">
                    <span>Set Status</span>
                    <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 ml-2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 8.25l-7.5 7.5-7.5-7.5" />
                    </svg>
                </button>
                <div x-cloak x-show="isOpen" @click.away="isOpen = false" @keydown.escape.window="isOpen = false"
                    x-transition.origin.top.left
                    class="absolute z-20 mt-2 text-sm font-semibold text-left bg-white shadow-lg w-76 rounded-xl">
                    <form action="#" class="px-4 py-6 space-y-4">
                        <div class="space-y-2">
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="radio" checked="" class="text-black border-none bg-slate-200"
                                        name="radio-direct" value="1">
                                    <span class="ml-2">Open</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="radio" checked="" class="border-none bg-slate-200 text-purple"
                                        name="radio-direct" value="2">
                                    <span class="ml-2">Considering</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="radio" checked="" class="border-none bg-slate-200 text-yellow"
                                        name="radio-direct" value="3">
                                    <span class="ml-2">In Progress</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="radio" checked="" class="border-none bg-slate-200 text-green"
                                        name="radio-direct" value="4">
                                    <span class="ml-2">Implemented</span>
                                </label>
                            </div>
                            <div>
                                <label class="inline-flex items-center">
                                    <input type="radio" checked="" class="border-none bg-slate-200 text-red"
                                        name="radio-direct" value="5">
                                    <span class="ml-2">Closed</span>
                                </label>
                            </div>
                        </div>
                        <div>
                            <textarea name="update_comment" id="update_comment" cols="30" rows="3"
                                class="w-full px-4 py-2 text-sm placeholder-gray-900 bg-gray-100 border-none rounded-xl"
                                placeholder="Add an update comment (optional)"></textarea>
                        </div>
                        <div class="flex items-center justify-between space-x-3">
                            <button type="button"
                                class="flex items-center justify-center w-1/2 px-6 py-3 text-xs transition duration-150 ease-in bg-gray-200 border border-gray-200 h-11 text-semibold rounded-xl hover:border-gray-400">
                                <svg fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                    class="w-4 h-4 text-gray-500 transform -rotate-45">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13" />
                                </svg>

                                <span class="ml-1">Attach</span>

                            </button>
                            <button type="submit"
                                class="flex items-center justify-center w-1/2 px-6 py-3 text-xs text-white transition duration-150 ease-in border h-11 bg-blue text-semibold rounded-xl border-blue hover:bg-blue-hover">
                                <span class="ml-1">Update</span>
                            </button>
                        </div>

                        <div>
                            <label for="" class="inline-flex items-center font-normal">
                                <input type="checkbox" name="notify_voters" class="bg-gray-200 rounded" checked="">
                                <span class="ml-2">Notify all voters</span>
                            </label>
                        </div>
                    </form>
                </div>
            </div> --}}
        </div>
        {{-- <div class="flex items-center space-x-3">
            <div class="px-3 py-2 font-semibold text-center bg-white rounded-xl">
                <div class="text-xl leading-snug">12</div>
                <div class="text-xs leading-none text-gray-400">Votes</div>
            </div>
            <button type="button"
                class="w-32 px-6 py-3 text-xs uppercase transition duration-150 ease-in bg-gray-200 border border-gray-200 h-11 text-semibold rounded-xl hover:border-gray-400">
                <span>vote</span>
            </button>
        </div> --}}
    </div> <!-- End of buttons-container -->
    @if($comments->isNotEmpty())
    <div class="relative pt-4 my-8 mt-1 space-y-6 ml-30.25 comments-container">
        @foreach ($comments as $comment)
        @livewire('show-comment', ['comment' => $comment], key($comment->id))
        @endforeach
    </div> <!-- End of comments-container -->
    @else
    <div class="relative py-16 mt-4 text-center bg-gray-200 ml-28 dark:bg-gray-800 rounded-xl">

        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="w-12 h-12 mx-auto text-gray-300">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M8.625 9.75a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H8.25m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0H12m4.125 0a.375.375 0 11-.75 0 .375.375 0 01.75 0zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 01.778-.332 48.294 48.294 0 005.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0012 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018z" />
        </svg>

        <h3 class="mt-2 text-sm font-semibold text-gray-900 dark:text-gray-200">No Comments</h3>
        <p class="mt-1 text-sm text-gray-500">Be the first to comment.</p>
    </div>
    @endif
</div>
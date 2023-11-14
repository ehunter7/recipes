<div x-data="{isOpen: false, isAdmin: @entangle('isAdmin')}" :class="isAdmin ? 'is-admin' : ''"
    class="relative flex mt-4 bg-gray-200 dark:bg-gray-700 comment-container rounded-xl">
    <div class="flex flex-1 px-4 py-6">
        <div class="flex-none">
            <a href="#">
                <img src="{{$this->author->profile_photo_url}}" alt="avatar" class="w-14 h-14 rounded-xl">
            </a>
            @if ($isAdmin)
            <div class="mt-1 text-xs font-bold text-center uppercase text-blue">Chef</div>
            @endif
        </div>
        <div class="w-full mx-4">
            <!-- <h4 class="text-xl font-semibold"><a href="#" class="hover:underline">A random title can go
                                here</a></h4> -->
            <div class="mt-3 text-gray-600 dark:text-gray-200 line-clamp-3">
                {{$comment->content}}
            </div>
            <div class="flex items-center justify-between mt-6">
                <div class="flex items-center space-x-2 text-xs font-semibold text-gray-400">
                    <div :class="isAdmin ? 'text-blue' : 'text-gray-900 dark:text-white'" class="font-bold">
                        {{$author->name}}</div>
                    <div>&bull;</div>
                    <div>{{$timeSince}}</div>

                </div>
                <div x-data="{isAdmin: @entangle('isAdmin'), isAuthor: @entangle('isAuthor')}"
                    class="flex items-center space-x-2">

                    <button x-cloak x-show="isAdmin || isAuthor" @click="isOpen = !isOpen"
                        class="relative px-3 py-2 transition duration-150 ease-in bg-gray-100 border rounded-full dark:bg-gray-700 hover:bg-gray-200 dark:hover:bg-gray-600 h-7">
                        <svg fill="currentColor" width="24" height="6">
                            <path
                                d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z"
                                style="color: rgba(163, 163, 163, .5)">
                        </svg>
                        <ul x-cloak x-show="isOpen" @click.away="isOpen = false" @keydown.escape.window="isOpen = false"
                            x-transition.origin.top.left
                            class="absolute z-10 w-40 py-3 font-semibold text-left bg-white shadow-xl dark:bg-gray-400 rounded-xl ">
                            <li x-cloak x-show="isAdmin"><a href="#"
                                    class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100 dark:hover:bg-gray-200">Mark
                                    as
                                    Spam</a>
                            </li>
                            <li><a href="#"
                                    class="block px-5 py-3 transition duration-150 ease-in hover:bg-gray-100 dark:hover:bg-gray-200">Delete
                                    Post</a>
                            </li>
                        </ul>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div><!-- End of comment-container -->
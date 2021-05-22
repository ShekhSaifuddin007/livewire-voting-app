<div
    x-data="ideaContainer()"
    @click="goToLink($event)"
    class="idea-container hover:shadow-md transition duration-150 ease-in bg-white rounded-xl flex cursor-pointer"
>
    <div class="hidden md:block border-r border-gray-100 px-5 py-8">
        <div class="text-center">
            <div class="font-semibold text-2xl">{{ $idea->votes_count }}</div>
            <div class="text-gray-500">Votes</div>
        </div>

        <div class="mt-8">
            <button class="w-20 bg-gray-200 border border-gray-200 focus:outline-none hover:border-teal-500 font-bold text-xxs uppercase rounded-xl transition duration-150 ease-in px-4 py-3">Vote</button>
        </div>
    </div>

    <div class="flex flex-col md:flex-row flex-1 px-2 py-6">
        <div class="flex-none mx-2 md:mx-0">
            <a href="{{ route('ideas.show', $idea) }}" class="idea-link">
                <img src="{{ $idea->user->photoUrl() }}" alt="avatar" class="w-14 h-14 rounded-xl">
            </a>
        </div>

        <div class="md:w-full flex flex-col justify-between mx-2 md:mx-4">
            <h4 class="text-lg md:text-xl mt-2 md:mt-0 font-semibold">
                <a href="{{ route('ideas.show', $idea) }}" class="idea-link hover:underline">{{ $idea->title }}</a>
            </h4>

            <div class="text-gray-600 mt-3 line-clamp-3 min-h-13">
                {{ $idea->description }}
            </div>

            <div class="flex flex-col items-start md:flex-row md:items-center justify-between mt-6">
                <div class="flex items-center text-xs text-gray-400 font-semibold space-x-1 md:space-x-2">
                    <div>{{ $idea->created_at->diffForHumans() }}</div>
                    <div>&bull;</div>
                    <div>{{ $idea->category->name }}</div>
                    <div>&bull;</div>
                    <div class="text-gray-900">3 Comments</div>
                </div>
                <div
                    x-data="{ isOpen: false }"
                    class="flex items-center space-x-2 mt-3 md:mt-0"
                >
                    <div class="{{ $idea->status->classes }} text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">{{ $idea->status->name }}</div>
                    <button
                        @click.prevent="isOpen = ! isOpen"
                        class="relative bg-gray-100 hover:bg-gray-200 rounded-full h-7 border focus:outline-none transition duration-150 ease-in py-2 px-3"
                    >
                        <svg fill="currentColor" width="24" height="6"><path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)"></svg>
                        <ul
                            x-cloak
                            x-show.transition.origin.top.left="isOpen"
                            @click.away="isOpen = false"
                            @keydown.escape.window="isOpen = false"
                            class="absolute right-0 {{ $bottomOrTop }} shadow-lg w-44 text-left font-semibold bg-white rounded-xl py-3"
                        >
                            <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark as Spam</a></li>
                            <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a></li>
                        </ul>
                    </button>
                </div>

                <div class="flex items-center md:hidden mt-4 md:mt-0">
                    <div class="bg-gray-100 text-center rounded-bl-full rounded-tl-full h-10 px-4 py-2 pr-8">
                        <div class="text-sm font-bold leading-none">{{ $idea->votes_count }}</div>
                        <div class="text-xxs font-semibold leading-none text-gray-400">Votes</div>
                    </div>
                    <button
                        class="w-20 bg-gray-200 border border-gray-200 font-bold text-xxs uppercase rounded-full focus:outline-none hover:border-teal-500 transition duration-150 ease-in px-4 py-3 -mx-5"
                    >
                        Vote
                    </button>
                </div>
            </div>
        </div>
    </div>
</div> <!-- end idea-container -->

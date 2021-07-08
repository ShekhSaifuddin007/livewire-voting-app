<div class="idea-button-container">
    <div class="idea-container shadow-md bg-white rounded-xl flex mt-4">
        <div class="flex flex-col md:flex-row flex-1 px-2 py-6">
            <div class="flex-none mx-2 md:mx-0">
                <a href="#">
                    <img src="{{ $idea->user->photoUrl() }}" alt="avatar" class="w-14 h-14 rounded-xl">
                </a>
            </div>

            <div class="flex flex-col justify-between mx-2 md:mx-4 w-full">
                <h4 class="text-lg md:text-xl mt-2 md:mt-0 font-semibold">
                    <span>{{ $idea->title }}</span>
                </h4>
                <div class="text-gray-600 mt-3">
                    @isadmin
                        @if ($idea->spam_reports > 0)
                            <div class="text-red-500 mb-2">Spam Reports: {{ $idea->spam_reports }}</div>
                        @endif
                    @endisadmin
                    {{ $idea->description }}
                </div>

                <div class="flex flex-col items-start md:flex-row md:items-center justify-between mt-6">
                    <div class="flex items-center text-xs text-gray-400 font-semibold space-x-1 md:space-x-2">
                        <div class="hidden md:block font-bold text-gray-900">{{ $idea->user->name }}</div>
                        <div class="hidden md:block">&bull;</div>
                        <div>{{ $idea->created_at->diffForHumans() }}</div>
                        <div>&bull;</div>
                        <div>{{ $idea->category->name }}</div>
                        <div>&bull;</div>
                        <div class="text-gray-900">3 Comments</div>
                    </div>

                    <div x-data="{ isOpen: false }" class="flex items-center space-x-2 mt-3 md:mt-0">
                        <div class="{{ $idea->status->classes }} text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">{{ $idea->status->name }}</div>

                        @auth
                            <div class="relative">
                                <button @click.prevent="isOpen = ! isOpen" class="bg-gray-100 hover:bg-gray-200 border rounded-full h-7 focus:outline-none transition duration-150 ease-in py-2 px-3">
                                    <svg fill="currentColor" width="24" height="6"><path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)"></svg>
                                </button>

                                <ul
                                    x-cloak
                                    x-show.transition.origin.top.left="isOpen"
                                    @click.away="isOpen = false"
                                    @keydown.escape.window="isOpen = false"
                                    class="absolute right-0 top-8 shadow-lg w-44 z-10 text-left font-semibold bg-white shadow-lg rounded-xl py-3">

                                    @can('update', $idea)
                                        <li>
                                            <a
                                                @click.prevent="
                                                    isOpen = false
                                                    $dispatch('custom-show-edit-modal')
                                                "
                                                href="#"
                                                class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">
                                                Edit Idea
                                            </a>
                                        </li>
                                    @endcan

                                    @can('delete', $idea)
                                        <li>
                                            <a
                                                @click.prevent="
                                                    isOpen = false
                                                    $dispatch('custom-show-delete-modal')
                                                "
                                                href="#"
                                                class="hover:bg-gray-100 block transition text-red-500 duration-150 ease-in px-5 py-3">Delete Idea</a>
                                        </li>
                                    @endcan

                                    <li>
                                        <a
                                            @click.prevent="
                                                isOpen = false
                                                $dispatch('custom-show-spam-modal')
                                            "
                                            href="#"
                                            class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark as Spam</a>
                                    </li>

                                    @isadmin
                                        @if ($idea->spam_reports > 0)
                                            <li>
                                                <a
                                                    @click.prevent="
                                                        isOpen = false
                                                        $dispatch('custom-show-not-spam-modal')
                                                    "
                                                    href="#"
                                                    class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Not Spam</a>
                                            </li>
                                        @endif
                                    @endisadmin
                                </ul>
                            </div>
                        @endauth

                    </div>

                    <div class="flex items-center md:hidden mt-4 md:mt-0">
                        <div class="bg-gray-100 text-center rounded-bl-full rounded-tl-full h-10 px-4 py-2 pr-8">
                            <div class="text-sm font-bold leading-none {{ $hasVoted ? 'text-teal-500' : '' }}">{{ $votesCount }}</div>
                            <div class="text-xxs font-semibold leading-none text-gray-400">Votes</div>
                        </div>
                        @if ($hasVoted)
                            <button
                                wire:click.prevent="vote"
                                class="w-20 bg-teal-500 text-white focus:outline-none hover:bg-teal-600 font-bold text-xxs uppercase rounded-full transition duration-150 ease-in px-4 py-3 -mx-5"
                            >
                                Voted
                            </button>
                        @else
                            <button
                                wire:click.prevent="vote"
                                class="w-20 bg-gray-200 border border-gray-200 font-bold text-xxs uppercase rounded-full focus:outline-none hover:border-teal-500 transition duration-150 ease-in px-4 py-3 -mx-5"
                            >
                                Vote
                            </button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- end idea-container -->

    <div class="buttons-container flex items-center justify-between mt-6">
        <div class="flex items-center space-x-6 md:space-x-4 ml-0 md:ml-6">
            <div x-data="{ isOpen: false }" class="relative">
                <button
                    @click.prevent="isOpen = ! isOpen"
                    type="button"
                    class="flex items-center justify-center h-11 w-32 text-xs md:text-sm bg-teal-500 text-white focus:outline-none font-semibold rounded-xl border border-blue hover:bbg-teal-600 transition duration-150 ease-in px-6 py-3"
                >
                    Reply
                </button>

                <div
                    x-cloak
                    x-show.transition.origin.top.left="isOpen"
                    @click.away="isOpen = false"
                    @keydown.escape.window="isOpen = false"
                    class="absolute z-10 w-72 md:w-104 text-left font-semibold text-sm bg-white shadow-lg rounded-xl mt-2"
                >
                    <form action="#" class="space-y-4 px-4 py-6">
                        <div>
                            <textarea name="post_comment" id="post_comment" rows="5" class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 border-none px-4 py-2" placeholder="Go ahead, don't be shy. Share your thoughts..."></textarea>
                        </div>

                        <div class="flex items-center space-x-3">
                            <button
                                type="button"
                                class="flex items-center justify-center h-11 w-1/2 text-sm bg-teal-500 text-white font-semibold focus:outline-none rounded-xl border border-blue hover:bg-teal-600 transition duration-150 ease-in px-6 py-3"
                            >
                                Comment
                            </button>
                            <button
                                type="button"
                                class="flex items-center justify-center w-32 h-11 text-xs bg-gray-200 font-semibold focus:outline-none rounded-xl border border-gray-200 hover:border-teal-500 transition duration-150 ease-in px-6 py-3"
                            >
                                <svg class="text-gray-600 w-4 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                                </svg>
                                <span class="ml-1">Attach</span>
                            </button>
                        </div>

                    </form>
                </div>
            </div>

            @isadmin
                <livewire:set-status :idea="$idea" />
            @endisadmin
        </div>

        <div class="hidden md:flex items-center space-x-3">
            <div class="bg-white font-semibold text-center rounded-xl px-3 py-2">
                <div class="text-xl leading-snug {{ $hasVoted ? 'text-teal-500' : '' }}">{{ $votesCount }}</div>
                <div class="text-gray-400 text-xs leading-none">Votes</div>
            </div>

            @if ($hasVoted)
                <button
                    wire:click.prevent="vote"
                    class="w-32 h-11 text-xs bg-teal-500 text-white font-semibold focus:outline-none uppercase rounded-xl hover:bg-teal-600 transition duration-150 ease-in px-6 py-3"
                >
                    Voted
                </button>
            @else
                <button
                    wire:click.prevent="vote"
                    class="w-32 h-11 text-xs bg-gray-200 font-semibold uppercase rounded-xl border border-gray-200 focus:outline-none hover:border-teal-500 transition duration-150 ease-in px-6 py-3"
                >
                    Vote
                </button>
            @endif
        </div>
    </div> <!-- end buttons-container -->
</div>

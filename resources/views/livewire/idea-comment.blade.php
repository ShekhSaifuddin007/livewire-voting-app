<div
    id="comment-{{ $comment->id }}"
    class="{{ $comment->is_status_update ? 'is-admin status-'.Str::kebab($comment->status->name) : null }} comment-container relative bg-white rounded-xl flex mt-4 transition duration-500 ease-in">
    <div class="flex flex-col md:flex-row flex-1 px-2 py-6">
        <div class="flex-none mx-2 md:mx-0">
            <a href="#">
                <img src="{{ $comment->user->photoUrl() }}" alt="avatar" class="w-14 h-14 rounded-xl">
            </a>
            @if ($comment->user->id === $ideaUserId)
                <div class="bg-gray-200 text-black font-semibold mt-2 w-fit-content px-2 py-1 rounded-full text-xs cursor-pointer" title="Original Poster">
                    Author
                </div>
            @endif

            @if ($comment->user->isAdmin())
                <div class="text-left ml-3 md:ml-0 md:text-center uppercase text-teal-500 text-xxs font-bold mt-1">Admin</div>
            @endif
        </div>

        <div class="md:w-full flex flex-col justify-between mx-2 md:mx-4">
            <div class="text-gray-600 mt-3 md:mt-0">
                @isadmin
                    @if ($comment->spam_reports > 0)
                        <div class="text-red-500 mb-2">Spam Reports: {{ $comment->spam_reports }}</div>
                    @endif
                @endisadmin

                @if ($comment->is_status_update)
                    <h4 class="text-lg md:text-xl font-semibold mb-3">
                        Status Changed to "{{ $comment->status->name }}"
                    </h4>
                @endif

                <div>
                    {{ $comment->body }}
                </div>
            </div>

            <div class="flex items-center justify-between mt-6">
                <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                    <div class="{{ $comment->is_status_update ? 'text-teal-500' : 'text-gray-900' }} font-bold">{{ $comment->user->name }}</div>
                    <div>&bull;</div>
                    <div>{{ $comment->created_at->diffForHumans() }}</div>
                </div>

                @auth
                    <div
                        class="text-gray-900 flex items-center space-x-2"
                        x-data="{ isOpen: false }"
                    >
                        <div class="relative">
                            <button
                                class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 focus:outline-none transition duration-150 ease-in py-2 px-3"
                                @click.prevent="isOpen = !isOpen"
                            >
                                <svg fill="currentColor" width="24" height="6"><path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)"></svg>
                            </button>
                            <ul
                                class="absolute right-0 {{ $bottomOrTop }} shadow-lg w-44 text-left z-10 font-semibold bg-white rounded-xl py-3"
                                x-cloak
                                x-show.transition.origin.top.left="isOpen"
                                @click.away="isOpen = false"
                                @keydown.escape.window="isOpen = false"
                            >
                                @can('update', $comment)
                                    <li>
                                        <a
                                            @click.prevent="
                                                isOpen = false
                                                Livewire.emit('setEditComment', {{ $comment->id }})
                                            "
                                            href="#"
                                            class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
                                        >
                                            Edit Comment
                                        </a>
                                    </li>
                                @endcan

                                @can('delete', $comment)
                                    <li>
                                        <a
                                            @click.prevent="
                                                isOpen = false
                                                Livewire.emit('setDeleteComment', {{ $comment->id }})
                                            "
                                            href="#"
                                            class="hover:bg-gray-100 block transition text-red-500 duration-150 ease-in px-5 py-3"
                                        >
                                            Delete Comment
                                        </a>
                                    </li>
                                @endcan

                                <li>
                                    <a
                                        @click.prevent="
                                            isOpen = false
                                            Livewire.emit('setMarkAsSpamComment', {{ $comment->id }})
                                        "
                                        href="#"
                                        class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3"
                                    >
                                        Mark as Spam
                                    </a>
                                </li>

                                @isadmin
                                    @if ($comment->spam_reports > 0)
                                        <li>
                                            <a
                                                @click.prevent="
                                                    isOpen = false
                                                    Livewire.emit('setMarkAsNotSpamComment', {{ $comment->id }})
                                                "
                                                href="#"
                                                class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Not Spam</a>
                                        </li>
                                    @endif
                                @endisadmin
                            </ul>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </div>
</div> <!-- end comment-container -->

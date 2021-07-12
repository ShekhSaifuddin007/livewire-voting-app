<div
    x-data="{ isOpen: false }"
    x-init="
        Livewire.on('commentWasAdded', () => {
            isOpen = false
        })

        Livewire.hook('message.processed', (message, component) => {
            {{-- if (message.updateQueue[0].method === 'gotoPage' || message.updateQueue[0].method === 'nextPage' || message.updateQueue[0].method === 'previousPage') { --}}
            if (['gotoPage', 'previousPage', 'nextPage'].includes(message.updateQueue[0].method)) {
                const firstComment = document.querySelector('.comment-container:first-child')
                firstComment.scrollIntoView({ behavior: 'smooth'})
            }

            if (message.updateQueue[0].payload.event === 'commentWasAdded'
             && message.component.fingerprint.name === 'idea-comments') {
                const lastComment = document.querySelector('.comment-container:last-child')
                lastComment.scrollIntoView({ behavior: 'smooth' })
                lastComment.classList.add('bg-green-50')
                setTimeout(() => {
                    lastComment.classList.remove('bg-green-50')
                }, 5000)
            }
        })
    "
    class="relative">
    <button
        @click.prevent="
            isOpen = ! isOpen

            if (isOpen) {
                $nextTick(() => $refs.comment.focus())
            }
        "
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

        @auth

            <form class="space-y-4 px-4 py-6" wire:submit.prevent="addComment">
                <div>
                    <textarea
                        x-ref="comment"
                        wire:model.defer="comment"
                        name="post_comment"
                        id="post_comment"
                        rows="5"
                        class="w-full text-sm bg-gray-100 rounded-xl focus:ring-teal-500 placeholder-gray-900 border-none px-4 py-2"
                        placeholder="Go ahead, don't be shy. Share your thoughts..." required></textarea>

                    @error('comment')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="flex items-center space-x-3">
                    <button
                        type="submit"
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
        @else
            <div class="px-4 py-6">
                <p class="font-normal">Please login or create an account to post a comment.</p>
                <div class="flex items-center space-x-3 mt-8">
                    <a
                        href="{{ route('login') }}"
                        class="w-1/2 h-11 text-sm text-center bg-teal-500 text-white font-semibold rounded-xl hover:bg-teal-600 transition duration-150 ease-in px-6 py-3"
                    >
                        Login
                    </a>
                    <a
                        href="{{ route('register') }}"
                        class="flex items-center justify-center w-1/2 h-11 text-sm bg-gray-200 font-semibold rounded-xl border hover:border-teal-500 transition duration-150 ease-in px-6 py-3"
                    >
                        Sign Up
                    </a>
                </div>
            </div>
        @endauth

    </div>
</div>

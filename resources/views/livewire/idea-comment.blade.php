<div class="comment-container relative bg-white rounded-xl flex mt-4">
    <div class="flex flex-col md:flex-row flex-1 px-2 py-6">
        <div class="flex-none mx-2 md:mx-0">
            <a href="#">
                <img src="{{ $comment->user->photoUrl() }}" alt="avatar" class="w-14 h-14 rounded-xl">
            </a>
            @if ($comment->user->id === $ideaUserId)
                <div class="bg-gray-200 font-semibold mt-2 w-fit-content px-2 py-1 rounded-full text-xs cursor-pointer" title="Original Poster">
                    Author
                </div>
            @endif
        </div>

        <div class="md:w-full flex flex-col justify-between mx-2 md:mx-4">
            <div class="text-gray-600 mt-3 md:mt-0">
                {{ $comment->body }}
            </div>

            <div class="flex items-center justify-between mt-6">
                <div class="flex items-center text-xs text-gray-400 font-semibold space-x-2">
                    <div class="font-bold text-gray-900">{{ $comment->user->name }}</div>
                    <div>&bull;</div>
                    <div>{{ $comment->created_at->diffForHumans() }}</div>
                </div>
                <div class="flex items-center space-x-2">
                    <button class="relative bg-gray-100 hover:bg-gray-200 border rounded-full h-7 focus:outline-none transition duration-150 ease-in py-2 px-3">
                        <svg fill="currentColor" width="24" height="6"><path d="M2.97.061A2.969 2.969 0 000 3.031 2.968 2.968 0 002.97 6a2.97 2.97 0 100-5.94zm9.184 0a2.97 2.97 0 100 5.939 2.97 2.97 0 100-5.939zm8.877 0a2.97 2.97 0 10-.003 5.94A2.97 2.97 0 0021.03.06z" style="color: rgba(163, 163, 163, .5)"></svg>
                        <ul class="hidden absolute right-0 top-8 shadow-lg w-44 text-left z-10 font-semibold bg-white rounded-xl py-3">
                            <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Mark as Spam</a></li>
                            <li><a href="#" class="hover:bg-gray-100 block transition duration-150 ease-in px-5 py-3">Delete Post</a></li>
                        </ul>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div> <!-- end comment-container -->

<div>
    <div class="hidden md:block">
        <div class="bg-white md:sticky md:top-8 border-2 rounded-xl mt-8 md:mt-16 custom-gradient">
            <div class="text-center px-6 py-2 pt-6">
                <h3 class="font-semibold text-base">Add an idea</h3>
                <p class="text-xs mt-4">
                    @auth
                        Let us know what you would like and we'll take a look over!
                    @else
                        Please login to create an idea
                    @endauth
                </p>
            </div>
            @auth
                <form wire:submit.prevent="createIdea" method="post" class="space-y-4 px-4 py-6">
                    <div>
                        <input wire:model.defer="title" type="text" class="w-full text-sm bg-gray-100 focus:ring-teal-500 border-none rounded-xl placeholder-gray-900 px-4 py-2" placeholder="Your Idea">
                        @error('title')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <select wire:model.defer="category" id="category" class="w-full bg-gray-100 focus:ring-teal-500 text-sm rounded-xl border-none px-4 py-2">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div>
                        <textarea wire:model.defer="description" id="description" rows="5" class="w-full bg-gray-100 focus:ring-teal-500 rounded-xl border-none placeholder-gray-900 text-sm px-4 py-2" placeholder="Describe your idea"></textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex items-center justify-between space-x-3">
                        <button
                            type="button"
                            class="flex items-center justify-center w-1/2 h-11 text-sm bg-gray-200 focus:outline-none font-semibold rounded-xl border border-gray-200 hover:border-teal-500 transition duration-150 ease-in px-6 py-3"
                        >
                            <svg class="text-gray-600 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                            </svg>
                            <span class="ml-1">Attach</span>
                        </button>
                        <button
                            type="submit"
                            class="flex items-center justify-center w-1/2 h-11 text-sm bg-teal-500 focus:outline-none text-white font-semibold rounded-xl hover:bg-teal-600 transition duration-150 ease-in px-6 py-3"
                        >
                            <svg class="w-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 15l-2 5L9 9l11 4-5 2zm0 0l5 5M7.188 2.239l.777 2.897M5.136 7.965l-2.898-.777M13.95 4.05l-2.122 2.122m-5.657 5.656l-2.12 2.122"></path>
                            </svg>
                            <span class="ml-1">Submit</span>
                        </button>
                    </div>

                    {{-- <div>
                        @if (session('message'))
                            <div
                                x-data="{ isVisible: true }"
                                x-init="
                                    setTimeout(() => {
                                        isVisible = false
                                    }, 3000)
                                "
                                x-show.transition.duration.1000ms="isVisible"

                                class="text-green-500 mt-4"
                            >
                                {{ session('message') }}
                            </div>
                        @endif
                    </div> --}}
                </form>
            @else
                <div class="my-6 text-center">
                    <a
                        wire:click.prevent="redirectToIntended('register')"
                        href="{{ route('register') }}"
                        class="inline-block justify-center w-1/2 h-11 text-sm bg-gray-200 focus:outline-none font-semibold rounded-xl border border-gray-200 hover:border-teal-500 transition duration-150 ease-in px-6 py-3"
                    >
                        Sign up
                    </a>

                    <a
                        wire:click.prevent="redirectToIntended"
                        href="{{ route('login') }}"
                        class="inline-block mt-2 justify-center w-1/2 h-11 text-sm bg-teal-500 focus:outline-none text-white font-semibold rounded-xl hover:bg-teal-600 transition duration-150 ease-in px-6 py-3"
                    >
                        Login
                    </a>
                </div>
            @endauth
        </div>
    </div>

    <button type="button" class="flex md:hidden items-center bg-teal-500 fixed z-10 bottom-8 right-8 focus:outline-none font-lobster px-5 py-3 rounded-full text-white">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        <span>Add an Idea</span>
    </button>
</div>


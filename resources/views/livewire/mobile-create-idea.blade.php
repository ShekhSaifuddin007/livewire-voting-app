<div x-data="{ isOpen: false }" x-cloak>
    <button @click.prevent="isOpen = true" type="button" class="flex md:hidden items-center bg-teal-500 fixed z-10 bottom-8 right-8 focus:outline-none font-lobster px-5 py-3 rounded-full text-white">
        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        <span>Add an Idea</span>
    </button>


    <!-- This example requires Tailwind CSS v2.0+ -->
    <div x-show="isOpen" class="fixed z-10 inset-0 overflow-y-auto" aria-labelledby="modal-title" role="dialog" aria-modal="true">
        <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
            <div x-show.transition.opacity="isOpen" class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
            <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>

            <div
                x-show.transition.origin.bottom.duration.300ms="isOpen"
                class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div @click.prevent="isOpen = false" class="flex justify-end text-red-600 px-2 py-1">
                        <span>
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </span>
                    </div>

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
                        <form @submit.prevent="$wire.createIdea()" method="post" class="space-y-4 px-4 py-6">
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
        </div>
    </div>
</div>

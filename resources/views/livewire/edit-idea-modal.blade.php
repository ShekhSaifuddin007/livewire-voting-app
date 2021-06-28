<div
    x-data="{ isOpen: false }"
    x-show="isOpen"
    @keydown.escape.window="isOpen = false"
    @custom-show-edit-modal.window="
        isOpen = true
        $nextTick(() => $refs.titleInput.focus())
    "
    x-cloak
    x-init="
        window.livewire.on('closeModalAndRefreshComponent', () => {
            isOpen = false
        })
    "
    class="fixed bottom-0 z-10 inset-0 overflow-y-auto"
    aria-labelledby="modal-title"
    role="dialog"
    aria-modal="true">

    <div class="flex items-end justify-center min-h-screen">
        <div
            x-show.transition.opacity="isOpen"
            class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>

        <div
            x-show.transition.origin.bottom.duration.300ms="isOpen"
            class="modal bg-white rounded-tl-xl rounded-tr-xl overflow-hidden transform transition-all p-4 sm:align-middle sm:max-w-lg sm:w-full">
            <div class="absolute top-0 right-0 pt-4 pr-4">
                <button
                    @click.prevent="isOpen = false"
                    class="text-gray-400 focus:outline-none hover:text-red-500">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <div class="bg-white pt-4">
                <h3 class="text-center font-medium text-lg">Edit Idea</h3>
                <p class="text-xs text-center px-4 leading-4 text-gray-500 my-4">You have one hour to edit your idea from the time you created it.</p>

                <form wire:submit.prevent="updateIdea" method="post" class="space-y-4 px-4">
                    <div>
                        <input wire:model.defer="title" x-ref="titleInput" type="text" class="w-full text-sm bg-gray-100 focus:ring-teal-500 border-none rounded-xl placeholder-gray-900 px-4 py-2" placeholder="Your Idea">
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
                            <span class="ml-1">Update</span>
                        </button>
                    </div>

                    <div>
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
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

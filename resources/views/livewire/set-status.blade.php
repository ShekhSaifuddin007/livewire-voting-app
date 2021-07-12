<div
    x-data="{ isOpen: false }"
    x-init="
        window.livewire.on('closeModalAndRefreshComponent', () => {
            isOpen = false
        })
    "
    class="relative"
>
    <button
        @click.prevent="isOpen = ! isOpen"
        type="button"
        class="flex items-center justify-center w-36 h-11 text-xs md:text-sm focus:outline-none bg-gray-200 font-semibold rounded-xl border border-gray-200 hover:border-teal-500 transition duration-150 ease-in px-6 py-3"
    >
        <span>Set Status</span>
        <svg class="w-4 h-4 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
        </svg>
    </button>

    <div
        x-cloak
        x-show.transition.origin.top.left="isOpen"
        @click.away="isOpen = false"
        @keydown.escape.window="isOpen = false"
        class="absolute z-20 w-72 md:w-76 right-0 md:left-0 text-left font-semibold text-sm bg-white shadow-lg rounded-xl mt-2"
    >
        <form wire:submit.prevent="setStatus" class="space-y-4 px-4 py-6">
            <div class="space-y-2">
                <div>
                    <label class="inline-flex items-center cursor-pointer">
                        <input wire:model="status" type="radio" class="bg-gray-200 text-gray-600 focus:ring-gray-600 border-none" name="status" value="1" checked>
                        <span class="ml-2">Open</span>
                    </label>
                </div>
                <div>
                    <label class="inline-flex items-center cursor-pointer">
                        <input wire:model="status" type="radio" class="bg-gray-200 text-purple-500 focus:ring-purple-500 border-none" name="status" value="2">
                        <span class="ml-2">Considering</span>
                    </label>
                </div>
                <div>
                    <label class="inline-flex items-center cursor-pointer">
                        <input wire:model="status" type="radio" class="bg-gray-200 text-yellow-500 focus:ring-yellow-500 border-none" name="status" value="3">
                        <span class="ml-2">In Progress</span>
                    </label>
                </div>
                <div>
                    <label class="inline-flex items-center cursor-pointer">
                        <input wire:model="status" type="radio" class="bg-gray-200 text-green-500 focus:ring-green-500 border-none" name="status" value="4">
                        <span class="ml-2">Implemented</span>
                    </label>
                </div>
                <div>
                    <label class="inline-flex items-center cursor-pointer">
                        <input wire:model="status" type="radio" class="bg-gray-200 text-red-500 focus:ring-red-500 border-none" name="status" value="5">
                        <span class="ml-2">Closed</span>
                    </label>
                </div>
            </div>

            <div>
                <textarea name="update_comment" id="update_comments" cols="30" rows="3" class="w-full text-sm bg-gray-100 rounded-xl placeholder-gray-900 border-none px-4 py-2" placeholder="Add an update comment (optional)"></textarea>
            </div>

            <div class="flex items-center justify-between space-x-3">
                <button
                    type="button"
                    class="flex items-center justify-center w-1/2 h-11 text-xs bg-gray-200 font-semibold focus:outline-none rounded-xl border border-gray-200 hover:border-teal-500 transition duration-150 ease-in px-6 py-3"
                >
                    <svg class="text-gray-600 w-4 transform -rotate-45" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13" />
                    </svg>
                    <span class="ml-1">Attach</span>
                </button>
                <button
                    type="submit"
                    class="disabled:opacity-50 flex items-center justify-center w-1/2 h-11 text-xs bg-teal-500 text-white focus:outline-none font-semibold rounded-xl border border-blue hover:bg-teal-600 transition duration-150 ease-in px-6 py-3"
                >
                    <span class="ml-1">Update</span>
                </button>
            </div>

            <div>
                <label class="font-normal inline-flex items-center">
                    <input wire:model="notifyAllVoters" type="checkbox" class="rounded text-teal-500 focus:ring-teal-500 bg-gray-200">
                    <span class="ml-2">Notify all voters</span>
                </label>
            </div>
        </form>
    </div>
</div>

@props([
    'redirect' => false,
    'message' => ''
])


<div
    x-data="{
        isOpen: false,
        successMessage: '{{ $message }}',
        notificationMessage(message) {
            this.successMessage = message
            this.isOpen = true
            setTimeout(() => {
                this.isOpen = false
            }, 2000)
        }
    }"
    x-init="
        @if ($redirect)
            $nextTick(() => notificationMessage(successMessage))
        @else
            Livewire.on('closeModalAndRefreshComponent', (message) => {
                notificationMessage(message)
            })

            Livewire.on('commentWasAdded', (message) => {
                notificationMessage(message)
            })

            Livewire.on('commentWasDeleted', (message) => {
                notificationMessage(message)
            })

            Livewire.on('commentWasMarkedAsSpam', (message) => {
                notificationMessage(message)
            })

            Livewire.on('commentWasMarkedAsNotSpam', (message) => {
                notificationMessage(message)
            })
        @endif
    "

    x-show="isOpen"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 transform translate-x-8"
    x-transition:enter-end="opacity-100 transform translate-x-0"
    x-transition:leave="transition ease-in duration-150"
    x-transition:leave-start="opacity-100 transform translate-x-0"
    x-transition:leave-end="opacity-0 transform translate-x-8"
    @keydown.escape.window="isOpen = false"
    x-cloak

    class="z-20 flex justify-between max-w-xs sm:max-w-sm w-full fixed bottom-0 right-0 bg-white rounded-xl shadow-lg border px-4 py-5 mx-2 sm:mx-6 my-8"
>
    <div class="flex items-center">
        <svg class="text-green-600 h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <div class="font-semibold text-gray-500 text-sm sm:text-base ml-2" x-text="successMessage"></div>
    </div>
    <button @click="isOpen = false" class="text-gray-400 hover:text-gray-500 focus:outline-none">
        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</div>

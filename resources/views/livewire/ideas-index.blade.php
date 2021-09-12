<div>
    <div class="filters flex flex-col md:flex-row space-y-3 md:space-y-0 md:space-x-6">
        <div class="w-full md:w-1/3">
            <select wire:model="category" id="category" class="w-full rounded-md focus:ring-teal-500 border-none px-4 py-2">
                <option value="all">All Categories</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->name }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="w-full md:w-1/3">
            <select wire:model="other" id="other" class="w-full rounded-md focus:ring-teal-500 border-none px-4 py-2">
                <option value="all">All</option>
                <option value="top-voted">Top Voted</option>
                <option value="my-ideas">My Ideas</option>
                @isadmin
                    <option value="spam-ideas">Spam Ideas</option>
                    <option value="spam-comments">Spam Comments</option>
                @endisadmin
            </select>
        </div>
        <div class="w-full md:w-2/3 relative">
            <input type="search" wire:model="search" placeholder="Find an idea" class="w-full rounded-md bg-white border-none focus:ring-teal-500 placeholder-gray-900 px-4 py-2 pl-8">
            <div class="absolute top-0 flex itmes-center h-full ml-2">
                <svg class="w-4 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                </svg>
            </div>
        </div>
    </div> <!-- end filters -->

    <div class="ideas-container space-y-6 my-6">
        @forelse ($ideas as $idea)
            <livewire:idea-index
                :idea="$idea"
                :key="'idea-'.$idea->id"
                :bottom-or-top="$loop->last ? 'bottom-8' : 'top-8'"
                :votes-count="$idea->votes_count"
            />
        @empty
            <div class="mx-auto w-70 mt-12">
                <img src="{{ asset('img/no-ideas.svg') }}" alt="No Ideas" class="mx-auto mix-blend-luminosity">
                <div class="text-gray-400 text-center font-bold mt-6">No ideas were found...</div>
            </div>
        @endforelse
    </div> <!-- end ideas-container -->

    <div class="mb-5">
        {{-- {{ $ideas->links() }} --}}
        {{ $ideas->appends(request()->query())->links() }}
    </div>
</div>

@push('scripts')
    <script>
        function ideaContainer() {
            return {
                goToLink(e) {
                    const target = e.target

                    const clicked = target.tagName.toLowerCase()

                    const ignores = ["button", "svg", "path", "a"]

                    if (! ignores.includes(clicked)) {
                        target.closest('.idea-container').querySelector('.idea-link').click()
                    }

                    // if (
                    //     clicked !== "button" &&
                    //     clicked !== "svg" &&
                    //     clicked !== "path" &&
                    //     clicked !== "a"
                    //    ) {
                    //     target.closest('.idea-container').querySelector('.idea-link').click()
                    // }
                }
            }
        }
    </script>
@endpush

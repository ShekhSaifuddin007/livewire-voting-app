<div>
    @if ($comments->isNotEmpty())
        <div class="comments-container relative space-y-6 ml-0 md:ml-22 pt-4 my-8 mt-1">

            @foreach ($comments as $comment)
                <livewire:idea-comment
                    :key="$comment->id"
                    :comment="$comment"
                    :ideaUserId="$idea->user->id"
                    :bottom-or-top="$loop->last ? 'bottom-8' : 'top-8'"
                />
            @endforeach

        </div> <!-- end comments-container -->

        <div class="my-8 md:ml-22">
            {{ $comments->onEachSide(1)->links() }}
        </div>
    @else
        <div class="mx-auto w-70 mt-12">
            <img src="{{ asset('img/no-ideas.svg') }}" alt="No Ideas" class="mx-auto" style="mix-blend-mode: luminosity">
            <div class="text-gray-400 text-center font-bold mt-6">No Comments yet...</div>
        </div>
    @endif
</div>

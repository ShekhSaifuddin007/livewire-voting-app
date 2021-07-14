<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Illuminate\Http\Response;

class MarkSpamCommentModal extends Component
{
    public Comment $comment;

    protected $listeners = ['setMarkAsSpamComment'];

    public function setMarkAsSpamComment($commentId)
    {
        $this->comment = Comment::query()->findOrFail($commentId);

        $this->emit('commentMarkAsSpamWasSet');
    }

    public function markAsSpam()
    {
        if (auth()->guest()) {
            abort(Response::HTTP_UNAUTHORIZED);
        }

        $this->comment->increment('spam_reports');

        $this->emit('commentWasMarkedAsSpam', 'Comment was marked as spam');
    }

    public function render()
    {
        return view('livewire.mark-spam-comment-modal');
    }
}

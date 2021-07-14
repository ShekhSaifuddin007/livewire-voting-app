<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Illuminate\Http\Response;

class MarkNotSpamCommentModal extends Component
{
    public Comment $comment;

    protected $listeners = ['setMarkAsNotSpamComment'];

    public function setMarkAsNotSpamComment($commentId)
    {
        $this->comment = Comment::query()->findOrFail($commentId);

        $this->emit('commentMarkAsNotSpamWasSet');
    }

    public function markNotAsSpam()
    {
        if (auth()->guest() || ! auth()->user()->isAdmin()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->comment->update([
            'spam_reports' => 0
        ]);

        $this->emit('commentWasMarkedAsNotSpam', 'Spam counter was reset.!');
    }

    public function render()
    {
        return view('livewire.mark-not-spam-comment-modal');
    }
}

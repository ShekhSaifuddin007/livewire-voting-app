<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Illuminate\Http\Response;

class DeleteCommentModal extends Component
{
    public Comment $comment;

    protected $listeners = ['setDeleteComment'];

    public function setDeleteComment($commentId)
    {
        $this->comment = Comment::query()->findOrFail($commentId);

        $this->emit('deleteCommentWasSet');
    }

    public function deleteComment()
    {
        if (auth()->guest() || auth()->user()->cannot('delete', $this->comment)) {
            abort(Response::HTTP_UNAUTHORIZED);
        }

        $this->comment->delete();

        $this->emit('commentWasDeleted', 'Comment was deleted successfully.!');
    }

    public function render()
    {
        return view('livewire.delete-comment-modal');
    }
}

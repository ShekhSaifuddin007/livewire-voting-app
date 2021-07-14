<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;
use Illuminate\Http\Response;

class EditCommentModal extends Component
{
    public Comment $comment;

    public $body = '';

    protected $rules = [
        'body' => 'required|min:4'
    ];

    protected $listeners = ['setEditComment'];

    public function setEditComment($commentId)
    {
        $this->comment = Comment::query()->findOrFail($commentId);

        $this->body = $this->comment->body;

        $this->emit('editCommentWasSet');
    }

    public function updateComment()
    {
        if (auth()->guest() || auth()->user()->cannot('update', $this->comment)) {
            abort(Response::HTTP_UNAUTHORIZED);
        }

        $this->validate();

        $this->comment->update([
            'body' => $this->body,
        ]);

        $this->emit('closeModalAndRefreshComponent', 'Comment was updated.!');
    }

    public function render()
    {
        return view('livewire.edit-comment-modal');
    }
}

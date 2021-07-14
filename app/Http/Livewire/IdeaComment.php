<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Livewire\Component;

class IdeaComment extends Component
{
    public $comment, $bottomOrTop;

    public $ideaUserId;

    protected $listeners = [
        'closeModalAndRefreshComponent' => '$refresh',
        'commentWasMarkedAsSpam' => '$refresh',
        'commentWasMarkedAsNotSpam' => '$refresh',
    ];

    public function mount(Comment $comment, $ideaUserId, $bottomOrTop)
    {
        $this->comment = $comment;

        $this->ideaUserId = $ideaUserId;

        $this->bottomOrTop = $bottomOrTop;
    }
    public function render()
    {
        return view('livewire.idea-comment');
    }
}

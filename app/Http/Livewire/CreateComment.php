<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Idea;
use App\Notifications\CommentAdded;
use Livewire\Component;
use Illuminate\Http\Response;

class CreateComment extends Component
{
    public $idea;

    public $comment;

    protected $rules = [
        'comment' => 'required|min:4'
    ];

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function addComment()
    {
        if (auth()->guest()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->validate();

        $comment = Comment::create([
            'user_id' => auth()->id(),
            'idea_id' => $this->idea->id,
            'status_id' => 1,
            'body' => $this->comment
        ]);

        $this->reset('comment');

        $this->idea->user->notify(new CommentAdded($comment));

        $this->emit('commentWasAdded', 'Comment was added on this idea successfully.!');
    }

    public function render()
    {
        return view('livewire.create-comment');
    }
}

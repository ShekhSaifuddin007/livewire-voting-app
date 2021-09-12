<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithAuthRedirects;
use App\Models\Idea;
use Livewire\Component;

class IdeaIndex extends Component
{
    use WithAuthRedirects;

    public $idea, $bottomOrTop;
    public $hasVoted;
    public $votesCount;

    public function mount(Idea $idea, $bottomOrTop, $votesCount)
    {
        $this->idea = $idea;
        $this->bottomOrTop = $bottomOrTop;
        $this->votesCount = $votesCount;
        $this->hasVoted = $idea->is_voted_by_user;
    }

    public function vote()
    {
        if (auth()->guest()) {
            $this->redirectToIntended();
        }

        if ($this->hasVoted) {
            $this->idea->vote(auth()->user());
            $this->votesCount--;
            $this->hasVoted = false;
        } else {
            $this->idea->vote(auth()->user());
            $this->votesCount++;
            $this->hasVoted = true;
        }
    }

    public function render()
    {
        return view('livewire.idea-index');
    }
}

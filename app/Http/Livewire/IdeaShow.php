<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithAuthRedirects;
use App\Models\Idea;
use Livewire\Component;

class IdeaShow extends Component
{
    use WithAuthRedirects;

    public $idea;
    public $votesCount;
    public $hasVoted;

    protected $listeners = [
        'closeModalAndRefreshComponent' => '$refresh',
        'commentWasAdded' => '$refresh',
        'commentWasDeleted' => '$refresh',
    ];

    public function mount(Idea $idea, $votesCount)
    {
        $this->idea = $idea;
        $this->votesCount = $votesCount;
        $this->hasVoted = $idea->isVotedBy(auth()->user());
    }

    // public function statusWasUpdated()
    // {
    //     $this->idea->refresh();
    // }

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
        return view('livewire.idea-show');
    }
}

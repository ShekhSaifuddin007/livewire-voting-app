<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;

class IdeaIndex extends Component
{
    public $idea, $bottomOrTop;
    public $hasVoted;

    public function mount(Idea $idea, $bottomOrTop)
    {
        $this->idea = $idea;
        $this->bottomOrTop = $bottomOrTop;
        $this->hasVoted = $idea->is_voted_by_user;
    }

    public function render()
    {
        return view('livewire.idea-index');
    }
}

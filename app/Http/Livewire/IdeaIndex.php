<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;

class IdeaIndex extends Component
{
    public $idea, $bottomOrTop;

    public function mount(Idea $idea, $bottomOrTop)
    {
        $this->idea = $idea;
        $this->bottomOrTop = $bottomOrTop;
    }

    public function render()
    {
        return view('livewire.idea-index');
    }
}

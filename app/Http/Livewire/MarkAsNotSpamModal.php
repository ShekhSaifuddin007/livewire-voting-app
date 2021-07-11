<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;
use Illuminate\Http\Response;

class MarkAsNotSpamModal extends Component
{
    public $idea;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function markNotAsSpam()
    {
        if (auth()->guest() || ! auth()->user()->isAdmin()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->idea->update([
            'spam_reports' => 0
        ]);

        $this->emit('closeModalAndRefreshComponent', 'Spam counter was reset.!');
    }

    public function render()
    {
        return view('livewire.mark-as-not-spam-modal');
    }
}

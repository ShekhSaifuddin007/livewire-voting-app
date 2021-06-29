<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Illuminate\Http\Response;
use Livewire\Component;

class MarkAsSpamModal extends Component
{
    public $idea;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function markAsSpam()
    {
        if (auth()->guest()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->idea->increment('spam_reports');

        $this->emit('closeModalAndRefreshComponent');
    }

    public function render()
    {
        return view('livewire.mark-as-spam-modal');
    }
}

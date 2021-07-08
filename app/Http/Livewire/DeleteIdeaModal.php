<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;
use Illuminate\Http\Response;

class DeleteIdeaModal extends Component
{
    public $idea;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }

    public function deleteIdea()
    {
        if (auth()->guest() || auth()->user()->cannot('delete', $this->idea)) {
            abort(Response::HTTP_UNAUTHORIZED);
        }

        $this->idea->votes()->detach();

        $this->idea->delete();

        session()->flash('message', 'Idea was deleted successfully.!');

        return redirect()->route('/');
    }

    public function render()
    {
        return view('livewire.delete-idea-modal');
    }
}

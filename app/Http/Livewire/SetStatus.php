<?php

namespace App\Http\Livewire;

use App\Jobs\NotifyAllVoters;
use App\Models\Idea;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Response;

class SetStatus extends Component
{
    public $idea;
    public $status;
    public $notifyAllVoters;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
        $this->status = $this->idea->status_id;
    }

    public function setStatus()
    {
        if (! auth()->check() || ! auth()->user()->isAdmin()) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->idea->status_id = $this->status;
        $this->idea->save();

        if ($this->notifyAllVoters) {
            NotifyAllVoters::dispatch($this->idea);
            // $this->notifyAllVoters();
        }

        $this->emit('statusWasUpdated');
    }

    // protected function notifyAllVoters()
    // {
    //     $this->idea->votes()
    //         ->select('name', 'email')
    //         ->chunk(100, function ($voters) {
    //             foreach ($voters as $user) {
    //                 Mail::to($user)
    //                     ->queue(new IdeaStatusUpdatedMailable($this->idea));
    //             }
    //         });
    // }

    public function render()
    {
        return view('livewire.set-status');
    }
}

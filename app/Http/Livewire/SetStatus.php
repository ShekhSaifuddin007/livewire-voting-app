<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Comment;
use Livewire\Component;
use App\Jobs\NotifyAllVoters;
use Symfony\Component\HttpFoundation\Response;

class SetStatus extends Component
{
    public $idea;
    public $status;
    public $comment;
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

        if ((int) $this->idea->status_id === (int) $this->status) {
            $this->emit('statusUpdatedError', 'Status is the same.!');

            return;
        }

        $this->idea->status_id = $this->status;
        $this->idea->save();

        Comment::create([
            'user_id' => auth()->id(),
            'idea_id' => $this->idea->id,
            'status_id' => $this->status,
            'body' => $this->comment ? $this->comment : 'No comment on this..!',
            'is_status_update' => true
        ]);

        $this->reset('comment');

        if ($this->notifyAllVoters) {
            NotifyAllVoters::dispatch($this->idea);
            // $this->notifyAllVoters();
        }

        $this->emit('closeModalAndRefreshComponent', 'Status has been changed.!');
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

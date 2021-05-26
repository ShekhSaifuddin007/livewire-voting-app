<?php

namespace App\Http\Livewire;

use App\Models\Status;
use Livewire\Component;
use Illuminate\Support\Facades\Route;

class StatusFilters extends Component
{
    public $status;
    public $statusCount;

    public function mount()
    {
        $this->statusCount = Status::getCount();

        $this->status = request()->status ?? 'all';

        if (Route::currentRouteName() === 'ideas.show') {
            $this->status = null;
            // $this->queryString = [];
        }
    }

    public function setStatus($status)
    {
        $this->status = $status;

        $this->emit('queryStringUpdatedStatus', $this->status);

        if ($this->getPreviousRouteName() === 'ideas.show') {
            return redirect()->route('/', [
                'status' => $this->status
            ]);
        }
    }

    public function getPreviousRouteName()
    {
        return app('router')->getRoutes()->match(app('request')->create(url()->previous()))->getName();
    }

    public function render()
    {
        return view('livewire.status-filters');
    }
}

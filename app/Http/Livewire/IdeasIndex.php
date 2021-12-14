<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Traits\WithAuthRedirects;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Vote;
use App\Models\Status;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class IdeasIndex extends Component
{
    use WithPagination, WithAuthRedirects;

    public $status = 'all';
    public $category;
    public $other;
    public $search;
    public $statusCount;

    protected $queryString = [
        'status',
        'category',
        'other',
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'queryStringUpdatedStatus'
    ];

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingOther()
    {
        $this->resetPage();
    }

    public function queryStringUpdatedStatus($status)
    {
        $this->resetPage();
        $this->status = $status;
    }

    public function updatedOther()
    {
        if ($this->other === 'my-ideas') {
            if (auth()->guest()) {
                $this->redirectToIntended();
            }
        }
    }

    public function render()
    {
        $statuses = $this->getStatuses();

        $categories = Category::all();

        $ideas = Idea::with(['user', 'category', 'status'])
            ->filter($this, $statuses, $categories)
            ->addSelect(['is_voted_by_user' => Vote::query()->select('id')
                ->where('user_id', auth()->id())
                ->whereColumn('idea_id', 'ideas.id')
            ])
            ->withCount('votes')
            ->withCount('comments')
            ->latest('id')->paginate();

        return view('livewire.ideas-index', compact('ideas', 'categories'));
    }

    private function getStatuses(): Collection
    {
        $getStatuses = Status::query()->get()->pluck('id', 'name');

        $statuses['open'] = $getStatuses['Open'];
        $statuses['considering'] = $getStatuses['Considering'];
        $statuses['progress'] = $getStatuses['In Progress'];
        $statuses['implemented'] = $getStatuses['Implemented'];
        $statuses['closed'] = $getStatuses['Closed'];

        return collect($statuses);
    }
}

<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Idea;
use App\Models\Vote;
use App\Models\Status;
use Livewire\Component;
use Livewire\WithPagination;

class IdeasIndex extends Component
{
    use WithPagination;

    public $status = 'all';
    public $category;
    public $statusCount;

    protected $queryString = [
        'status',
        'category'
    ];

    protected $listeners = [
        'queryStringUpdatedStatus'
    ];

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function queryStringUpdatedStatus($status)
    {
        $this->resetPage();
        $this->status = $status;
    }

    public function render()
    {
        $statuses = $this->getStatuses();

        $ideas = Idea::with(['user', 'category', 'status'])
            ->when($this->status && $this->status !== 'all', function ($query) use ($statuses) {
                return $query->where('status_id', $statuses->get($this->status));
            })
            ->addSelect(['is_voted_by_user' => Vote::query()->select('id')
                ->where('user_id', auth()->id())
                ->whereColumn('idea_id', 'ideas.id')
            ])
            ->withCount('votes')
            ->latest('id')->paginate(3);

        $categories = Category::all();

        return view('livewire.ideas-index', compact('ideas', 'categories'));
    }

    private function getStatuses()
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

<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Idea;
use App\Models\Vote;
use App\Models\Status;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class IdeasIndex extends Component
{
    use WithPagination;

    public $status = 'all';
    public $category;
    public $other;
    public $search;
    public $statusCount;

    protected $queryString = [
        'status',
        'category',
        'other',
        'search'
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
            if (! auth()->check()) {
                return redirect()->route('login');
            }
        }
    }

    public function render()
    {
        $statuses = $this->getStatuses();

        $categories = Category::all();

        $ideas = Idea::with(['user', 'category', 'status'])
            ->when($this->status && $this->status !== 'all', function ($query) use ($statuses) {
                return $query->where('status_id', $statuses->get($this->status));
            })
            ->when($this->category && $this->category !== 'all', function ($query) use ($categories) {
                return $query->where('category_id', $categories->pluck('id', 'name')->get($this->category));
            })
            ->when($this->other && $this->other === 'top-voted', function ($query) {
                return $query->orderByDesc('votes_count');
            })
            ->when($this->other && $this->other === 'my-ideas', function ($query) {
                return $query->where('user_id', auth()->id());
            })
            ->when($this->other && $this->other === 'spam-ideas', function ($query) {
                return $query->where('spam_reports', '>', 0)->orderByDesc('spam_reports');
            })
            ->when($this->other && $this->other === 'spam-comments', function ($query) {
                return $query->whereHas('comments', function ($query) {
                    return $query->where('spam_reports', '>', 0)->orderByDesc('spam_reports');
                });
            })
            ->when(strlen($this->search) >= 3, function ($query) {
                return $query->where('title', 'like', "%{$this->search}%");
            })
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

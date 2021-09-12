<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use App\Models\Idea;
use Livewire\Component;
use Illuminate\Http\Response;
use Illuminate\Notifications\DatabaseNotification;

class CommentNotifications extends Component
{
    const NOTIFICATION_TRASHHOLD = 20;

    public $notifications;

    public $notificationCount;
    public $isLoading = true;

    protected $listeners = [
        'getNotifications'
    ];

    public function mount()
    {
        $this->notifications = collect([]);

        $this->getNotificationCount();
    }

    public function getNotificationCount()
    {
        $this->notificationCount = auth()->user()->unreadNotifications()->count();

        if ($this->notificationCount > self::NOTIFICATION_TRASHHOLD) {
            $this->notificationCount = self::NOTIFICATION_TRASHHOLD.'+';
        }
    }

    public function getNotifications()
    {
        sleep(1);

        $this->notifications = auth()->user()
            ->unreadNotifications()
            ->latest()
            ->take(self::NOTIFICATION_TRASHHOLD)
            ->get();

        $this->isLoading = false;
    }

    public function markAllAsRead()
    {

        auth()->user()->unreadNotifications->markAsRead();

        $this->getNotifications();

        $this->getNotificationCount();
    }

    public function markAsRead($notificationId)
    {
        if (auth()->guest()) {
            abort(Response::HTTP_UNAUTHORIZED);
        }

        $notification = DatabaseNotification::query()->findOrFail($notificationId);

        $notification->markAsRead();

        $this->andScrollToComment($notification);
    }

    protected function andScrollToComment($notification)
    {
        $comment = Comment::query()->find($notification->data['comment_id']);

        $idea = Idea::query()->find($notification->data['idea_id']);

        if (! $comment || ! $idea) {
            session()->flash('error_message', 'This Content is no longer exists..!');

            return redirect()->route('/');
        }

        $comments = $idea->comments()->pluck('id');

        $indexOfComment = $comments->search($comment->id);

        $page = (int) ($indexOfComment / $comment->getPerPage()) + 1;

        session()->flash('scrollToComment', $comment->id);

        return redirect()->route('ideas.show', [
            'idea' => $notification->data['idea_slug'],
            'page' => $page
        ]);
    }

    public function render()
    {
        return view('livewire.comment-notifications');
    }
}

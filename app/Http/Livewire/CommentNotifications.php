<?php

namespace App\Http\Livewire;

use Livewire\Component;

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

    public function render()
    {
        return view('livewire.comment-notifications');
    }
}

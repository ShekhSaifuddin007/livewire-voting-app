<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Idea extends Model
{
    use HasFactory, Sluggable;

    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function status(): BelongsTo
    {
        return $this->belongsTo(Status::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    public function votes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'votes');
    }

    // public function votes(): MorphToMany
    // {
    //     return $this->morphToMany(Idea::class, 'voteable');
    // }

    public function isVotedBy($user)
    {
        if (!$user) {
            return false;
        }

        return Vote::query()->where('user_id', $user->id)
            ->where('idea_id', $this->id)
            ->exists();
    }

    public function vote($user)
    {
        $this->votes()->toggle($user);
        // $this->votes()->attach($user);
        // Vote::create([
        //     'idea_id' => $this->id,
        //     'user_id' => $user->id,
        // ]);
    }

    // public function removeVote($user)
    // {
    //     $this->votes()->detach($user);
    //     Vote::query()->where('idea_id', $this->id)
    //         ->where('user_id', $user->id)
    //         ->first()
    //         ->delete();
    // }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function scopeFilter($query, $self, $statuses, $categories)
    {
        return $query->when($self->status && $self->status !== 'all', function ($query) use ($statuses, $self) {
            return $query->where('status_id', $statuses->get($self->status));
        })
        ->when($self->category && $self->category !== 'all', function ($query) use ($categories, $self) {
            return $query->where('category_id', $categories->pluck('id', 'name')->get($self->category));
        })
        ->when($self->other && $self->other === 'top-voted', function ($query) {
            return $query->orderByDesc('votes_count');
        })
        ->when($self->other && $self->other === 'my-ideas', function ($query) {
            return $query->where('user_id', auth()->id());
        })
        ->when($self->other && $self->other === 'spam-ideas', function ($query) {
            return $query->where('spam_reports', '>', 0)->orderByDesc('spam_reports');
        })
        ->when($self->other && $self->other === 'spam-comments', function ($query) {
            return $query->whereHas('comments', function ($query) {
                return $query->where('spam_reports', '>', 0)->orderByDesc('spam_reports');
            });
        })
        ->when(strlen($self->search) >= 3, function ($query) use ($self) {
            return $query->where('title', 'like', "%{$self->search}%");
        });
    }

    protected static function booted()
    {
        if (! app()->runningInConsole()) {
            static::creating(function ($model) {
                $model->user_id = auth()->id();
            });
        }
    }

    // public function getStatuses()
    // {
    //     $statuses = [
    //         'Open' => 'bg-gray-200',
    //         'Considering' => 'bg-purple-500 text-white',
    //         'In Progress' => 'bg-yellow-500 text-white',
    //         'Implemented' => 'bg-green-500 text-white',
    //         'Closed'      => 'bg-red-500 text-white'
    //     ];

    //     return $statuses[$this->status->name];

    //     if ($this->status->name === 'Open') {
    //         return 'bg-gray-200';
    //     } elseif ($this->status->name === 'Considering') {
    //         return 'bg-purple-500 text-white';
    //     } elseif ($this->status->name === 'In Progress') {
    //         return 'bg-yellow-500 text-white';
    //     } elseif ($this->status->name === 'Implemented') {
    //         return 'bg-green-500 text-white';
    //     } elseif ($this->status->name === 'Closed') {
    //         return 'bg-red-500 text-white';
    //     }

    //     return 'bg-gray-200';
    // }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;

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

    // protected static function booted()
    // {
    //     static::creating(function ($model) {
    //         $model->user_id = auth()->id();
    //     });
    // }

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

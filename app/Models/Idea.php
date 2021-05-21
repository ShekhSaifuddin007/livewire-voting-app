<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->user_id = auth()->id();
        });

        // static::updating(function ($model) {
        //     $model->users_id = auth()->id();
        // });
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

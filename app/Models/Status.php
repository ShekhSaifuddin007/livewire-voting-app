<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Status extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function ideas(): HasMany
    {
        return $this->hasMany(Idea::class);
    }
}

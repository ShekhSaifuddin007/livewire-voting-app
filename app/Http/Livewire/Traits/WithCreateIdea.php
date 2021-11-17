<?php

namespace App\Http\Livewire\Traits;

use App\Models\Category;
use App\Models\Idea;

trait WithCreateIdea
{
    public $title, $category = 1, $description;

    protected $rules = [
        'title' => 'required|min:4',
        'category' => 'required|integer|exists:categories,id',
        'description' => 'required|min:4',
    ];

    public function create()
    {
        $this->validate();

        Idea::create([
            'category_id' => $this->category,
            'status_id' => 1,
            'title' => $this->title,
            'description' => $this->description
        ]);

        session()->flash('message', 'Idea has been added successfully.!');

        $this->reset();
    }

    public function categories()
    {
        return Category::all();
    }
}

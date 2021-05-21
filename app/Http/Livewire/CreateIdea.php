<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;
use App\Models\Category;
use Symfony\Component\HttpFoundation\Response;

class CreateIdea extends Component
{
    public $title, $category = 1, $description;

    protected $rules = [
        'title' => 'required|min:4',
        'category' => 'required|integer',
        'description' => 'required|min:4',
    ];

    public function createIdea()
    {
        if (auth()->check()) {
            $this->validate();

            Idea::create([
                'category_id' => $this->category,
                'status_id' => 1,
                'title' => $this->title,
                'description' => $this->description
            ]);

            session()->flash('message', 'Idea has been added successfully.!');

            $this->reset();

            return redirect()->route('/');
        }

        abort(Response::HTTP_FORBIDDEN);
    }

    public function render()
    {
        $categories = Category::all();

        return view('livewire.create-idea', compact('categories'));
    }
}

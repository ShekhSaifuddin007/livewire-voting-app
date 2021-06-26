<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Idea;

class EditIdeaModal extends Component
{
    public $idea;
    public $title;
    public $category;
    public $description;

    public function mount(Idea $idea)
    {
        $this->idea = $idea;
        $this->title = $idea->title;
        $this->category = $idea->category_id;
        $this->description = $idea->description;
    }

    public function updateIdea()
    {
        $this->idea->update([
            'title' => $this->title,
            'category_id' => $this->category,
            'description' => $this->description
        ]);

        $this->emit('closeModalAndRefreshComponent');
    }

    public function render()
    {
        return view('livewire.edit-idea-modal', [
            'categories' => Category::all(),
        ]);
    }
}

<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Illuminate\Http\Response;
use App\Http\Livewire\Traits\WithCreateIdea;
use App\Http\Livewire\Traits\WithAuthRedirects;

class CreateIdea extends Component
{
    use WithAuthRedirects, WithCreateIdea;

    public function createIdea()
    {
        if (auth()->check()) {
            $this->create();

            return redirect()->route('/');
        }

        abort(Response::HTTP_FORBIDDEN);
    }

    public function render()
    {
        $categories = $this->categories();

        return view('livewire.create-idea', compact('categories'));
    }
}

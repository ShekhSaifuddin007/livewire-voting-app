<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeasController extends Controller
{
    public function index()
    {
        $ideas = Idea::with(['user', 'category', 'status'])
            ->withCount('votes')
            ->latest('id')->paginate(10);

        // dd($ideas);

        return view('idea.index', compact('ideas'));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Idea $idea)
    {
        $votesCount = $idea->votes()->count();

        return view('idea.show', compact('idea', 'votesCount'));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Idea;
use Illuminate\Http\Request;

class IdeasController extends Controller
{
    public function index()
    {
        return response(view('idea.index'))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate');
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

        return response(view('idea.show', compact('idea', 'votesCount')))
            ->header('Cache-Control', 'no-cache, no-store, must-revalidate');
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

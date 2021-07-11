<?php

namespace Database\Seeders;

use App\Models\Idea;
use App\Models\Vote;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class IdeaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Idea::factory(100)->create();

        foreach (range(1, 20) as $user) {
            foreach (range(1, 100) as $idea) {
                if ($idea % 2 === 0) {
                    Vote::create([
                        'idea_id' => $idea,
                        'user_id' => $user,
                    ]);
                }
            }
        }

        // Generate comments for ideas
        foreach (Idea::all() as $idea) {
            Comment::factory(5)->existing()->create(['idea_id' => $idea->id]);
        }
    }
}

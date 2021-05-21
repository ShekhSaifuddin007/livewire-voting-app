<?php

namespace Tests\Feature;

use App\Models\Idea;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ShowIdeaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function list_of_ideas_shows_on_main_page()
    {
        $one = Idea::factory()->create([
            'title' => 'First Title',
            'description' => 'First Title Description'
        ]);

        $two = Idea::factory()->create([
            'title' => 'Second Title',
            'description' => 'Second Title Description'
        ]);

        $response = $this->get(route('/'));

        $response->assertSuccessful();
        $response->assertSee($one->title);
        $response->assertSee($one->description);
        $response->assertSee($two->title);
        $response->assertSee($two->description);
    }
}

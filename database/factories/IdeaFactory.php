<?php

namespace Database\Factories;

use App\Models\Idea;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class IdeaFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Idea::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => $title = ucwords($this->faker->words(4, true)),
            'slug' => Str::slug($title),
            'description' => $this->faker->paragraph(5)
        ];
    }
}

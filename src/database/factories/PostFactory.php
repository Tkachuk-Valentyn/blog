<?php

namespace Database\Factories;

use App\Models\Post;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    protected $model = Post::class;

    /**
     * @return array|mixed[]
     */
    public function definition(): array
    {
        return [
            'header' => fake()->sentence,
            'text' => fake()->sentence,
            'photo' => fake()->imageUrl,
            'slug' => fake()->sentence,
            'author' => 1
        ];
    }
}

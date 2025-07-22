<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $title = fake()->realText(50);
        return [
            'title' => $title,
            'slug' => Str::slug($title),
//            'thumbnail' => fake()->imageUrl(),
            'thumbnail' => $this->faker->imageUrl(),
            'body' => $this->faker->realText(500),
//            'active' => fake()->boolean,
            'active' => $this->faker->boolean(),
//            'published_at' => fake()->dateTime,
            'published_at' => $this->faker->date(),
//            'user_id' => $this->faker->numberBetween(1, 10),
            'user_id' => 1,
        ];
    }
}

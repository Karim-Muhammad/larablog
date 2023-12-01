<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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
        return [
            //
            "title" => $this->faker->sentence(),
            "description" => $this->faker->sentence(),
            "image" => $this->faker->imageUrl(),
            "status" => $this->faker->randomElement(["draft", "published"]),
            "body" => $this->faker->paragraph(),
            "slug" => $this->faker->slug(),
            "user_id" => 1,
            "category_id" => $this->faker->numberBetween(1, 7),
        ];
    }
}

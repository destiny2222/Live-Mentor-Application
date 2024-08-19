<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        $title = fake()->jobTitle();
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'description' => fake()->paragraph(3),
            'duration' => fake()->randomDigit(),
            'status' => fake()->randomElement(['1', '0']),
            'author' => fake()->name(),
            'level' => fake()->randomElement(['beginner', 'intermediate', 'advanced']),
            'category_id' => fake()->randomElement([1, 2, 3, 4, 5, 6, 7, 8, 9]),
            'price' => fake()->randomFloat(2, 10, 1000),
            'image' => fake()->imageUrl(640, 480, 'technology', true),
        ];
    }
}

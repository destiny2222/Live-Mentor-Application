<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $titles = [
            'Lifestyle',
            'Video & Animation',
            'Music & Audio',
            'Web Developer',
            'Front End Developer',
            'Back End Developer',
            'Full Stack Developer',
            'Graphics & Design',
            'Digital Marketing',
            'Writing & Translation'
        ];
        
        $name = $this->faker->unique()->randomElement($titles);
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'image' => $this->faker->imageUrl(640, 480),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    
}

<?php
namespace Database\Factories;
use App\Models\Blog;
use Illuminate\Database\Eloquent\Factories\Factory;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition()
    {
        return [
            'image' => $this->faker->imageUrl(),
            'title' => $this->faker->sentence,
            'description' => $this->faker->sentence,
            'details' => $this->faker->paragraph,
        ];
    }
}

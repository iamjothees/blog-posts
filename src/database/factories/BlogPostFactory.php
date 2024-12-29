<?php

namespace Database\Factories;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BlogPostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BlogPost::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = fake()->sentence();
        return [
            'title' => $title,
            'slug' => Str::slug($title),
            'excerpt' => fake()->paragraph(),
            'category_id' => Category::factory(),
            'content' => fake()->paragraphs(5, true),
            'user_id' => User::factory(),
            'featured_image' => fake()->imageUrl(800, 600, 'blog', true, 'Faker'),
            'status' => fake()->randomElement(['draft', 'published', 'archived']),
        ];
    }
}

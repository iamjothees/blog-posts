<?php

namespace Database\Seeders;

use App\Models\BlogPost;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@test.dev',
            'is_admin' => true,
            'password' => Hash::make('admin@123'),
        ]);


        User::factory()->create([
            'name' => 'User',
            'email' => 'user@test.dev',
            'is_admin' => false,
            'password' => Hash::make('user@123'),
        ]);

        User::factory(3)->create(['is_admin' => false]);

        $posts = BlogPost::factory(30)
            ->recycle(Category::factory(5)->create())
            ->recycle(User::all())
            ->create();

        $tags = Tag::factory(15)->create();

        $posts->each(
            fn ($post) => $post->tags()->attach($tags->random(rand(1, 5))->pluck('id'))
        );
    }
}

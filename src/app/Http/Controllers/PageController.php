<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PageController extends Controller
{
    public function home(){
        return view('home', ['posts' => \App\Models\BlogPost::active()->latest()->take(6)->get()]);
    }

    public function blogsIndex(){
        $posts = BlogPost::active()
            ->when(
                request('search'),
                fn($query, $search) => $query->where('title', 'like', "%{$search}%")
            )
            ->when(
                request('category'),
                fn($query, $category) => $query->whereHas('category', fn($query) => $query->where('slug', $category))
            )
            ->when(
                request('author'),
                fn($query, $author) => $query->whereHas('user', fn($query) => $query->where('email', $author))
            )
            ->when(
                request('tag'),
                fn($query, $tag) => $query->whereHas('tags', fn($query) => $query->where('tags.slug', $tag))
            )
            ->latest()
            ->paginate();

        $categories = Cache::get(
                            'categories', 
                            Category::whereHas('posts', fn ($q) => $q->active() )->get()
                        );
        return view('blogs.index', ['posts' => $posts, 'categories' => $categories]);
    }

    public function blogsShow(BlogPost $post){
        return view('blogs.show', ['post' => $post]);
    }
}

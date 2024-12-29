@extends('layouts.app')

@section('content')
<article class="max-w-3xl mx-auto bg-white shadow rounded overflow-hidden">
    <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-full h-64 object-cover">
    <div class="p-6">
            <h1 class="text-3xl font-bold mb-4">{{ $post->title }}</h1>
        
        <div class="mb-4">
            <p class="text-sm text-gray-500 mb-2">
                Posted by <a href="{{ route('blogs.index', ['author' => $post->user->email, ...request()->except('author')]) }}" class="font-bold">{{ $post->user->name }}</a> on {{ $post->created_at->format('M d, Y') }}
            </p>
            <x-blog-tags :tags="$post->tags" />
        </div>
        <div class="text-gray-800 leading-relaxed">
            {!! $post->content !!}
        </div>
    </div>
</article>
@endsection

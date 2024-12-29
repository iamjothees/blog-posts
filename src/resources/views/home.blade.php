@extends('layouts.app')

@section('content')
<div class="text-center">
    <h1 class="text-4xl font-bold mb-4">Welcome to My Blog</h1>
    <p class="text-lg text-gray-600">Sharing insights, thoughts, and stories.</p>
</div>

<div class="mt-8 grid md:grid-cols-3 gap-6">
    @foreach ($posts as $post)
        <x-blog-post-card :post="$post" />
    @endforeach
</div>
<div class="flex justify-center mt-8">
    <div 
        onclick="window.location.href = '{{ route('blogs.index') }}'"
        class="bg-white px-3 py-2 rounded-full cursor-pointer hover:text-indigo-600 font-bold"
    >
        See More...
    </div>
</div>
@endsection

@extends('layouts.app')

@section('content')
<div class="flex gap-3">
    <x-blog-category-filter :categories="$categories" class="flex-grow-1" />
    
    <div>
        <h1 class="text-3xl font-bold mb-6"> Blog Posts </h1>
    
        <x-blog-filters :filters="request()->only(['category', 'tag', 'author'])" />
    
        <div class="grid md:grid-cols-2 gap-6">
            @foreach ($posts as $post)
                <x-blog-post-card :post="$post" />
            @endforeach
        </div>
        <div>
            {{ $posts->links() }}
        </div>
    </div>
</div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.posts').forEach(
            postEl => postEl.addEventListener('click', () => postEl.querySelector('a').click())
        )
    </script>
    
@endpush


<div class="posts bg-white shadow rounded overflow-hidden cursor-pointer">
    <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
    <x-blog-tags :tags="$post->tags" class="p-2" />
    <div class="p-4">
        <h2 class="text-xl font-bold mb-2">
            <a href="{{ route('blogs.show', $post->slug) }}" class="hover:text-indigo-600">{{ $post->title }}</a>
        </h2>
        <p class="text-gray-600 text-sm">{{ $post->excerpt }}</p>
    </div>
</div>
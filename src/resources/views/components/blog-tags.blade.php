@php($colors = ['red', 'blue', 'green', 'purple', 'pink', 'yellow', 'indigo'])
<ul {{ $attributes->merge(['class' => 'flex flex-wrap gap-2']) }}>
    @foreach ($tags as $tag)
        <li 
            onclick="event.stopPropagation(); window.location.href = '{{ route('blogs.index', ['tag' => $tag->slug, ...request()->except('tag')]) }}';"
            class="inline-block border-2 border-{{ $colors[$loop->index] }}-300 text-{{ $colors[$loop->index] }}-600 px-3 py-1/2 rounded-full text-sm hover:bg-{{ $colors[$loop->index] }}-100 transition cursor-pointer"
        >
            #{{ $tag->name }}
        </li>
    @endforeach
</ul>
{{-- 
    class="border-red-300 border-blue-300 border-green-300 border-purple-300 border-pink-300 border-yellow-300 border-indigo-300"
    class="text-red-600 text-blue-600 text-green-600 text-purple-600 text-pink-600 text-yellow-600 text-indigo-600"
    class="hover:bg-red-100 hover:bg-blue-100 hover:bg-green-100 hover:bg-purple-100 hover:bg-pink-100 hover:bg-yellow-100 hover:bg-indigo-100"
 --}}

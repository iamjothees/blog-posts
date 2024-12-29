<div {{ $attributes->merge(['class' => "bg-white p-4 rounded-md shadow-md min-w-64"]) }}>
    <h3 class="text-lg font-bold mb-4">Categories</h3>
    <!-- Radio Buttons for Categories -->
    <ul class="space-y-2">
        @foreach ($categories as $category)
            <li>
                <label class="flex items-center gap-2 group">
                    <input 
                        type="radio" 
                        name="category" 
                        value="{{ $category->id }}" 
                        onchange="window.location.href = '{{ route('blogs.index', [ 'category' => $category->slug, ...request()->except('category') ]) }}';"
                        {{ request()->get('category') == $category->id ? 'checked' : '' }}
                        class="hidden"
                    />
                    <span 
                        class="w-full block px-3 py-2 text-sm rounded-md cursor-pointer border transition-all group-hover:border-blue-500 group-hover:text-blue-500
                        {{ request()->get('category') == $category->id ? 'border-blue-500 text-blue-500' : 'border-gray-300' }}"
                    >
                        {{ $category->name }}
                    </span>
                </label>
            </li>
        @endforeach
    </ul>
</div>

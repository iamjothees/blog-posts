<div class="bg-gray-100 p-4 rounded-md shadow-sm">
    @if ($filters && count($filters) > 0)
    <h3 class="text-lg font-bold text-gray-800 mb-2">Active Filters</h3>
    
        <div class="flex flex-wrap gap-2">
            @foreach ($filters as $key => $value)
                <div class="inline-flex items-center bg-blue-100 text-blue-600 border border-blue-500 px-3 py-1 rounded-full text-sm">
                    <span class="mr-2">{{ str($key)->replace('_', ' ')->title() }}: {{ $value }}</span>
                    <a 
                        href="{{ request()->fullUrlWithQuery([$key => null]) }}" 
                        class="text-blue-500 hover:text-blue-700"
                        title="Remove filter"
                    >
                        &times;
                    </a>
                </div>
            @endforeach
        </div>
    @endif
</div>

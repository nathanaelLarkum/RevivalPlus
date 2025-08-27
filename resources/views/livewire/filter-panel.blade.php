<div class="space-y-6">
    @foreach ($tagCategories as $category => $tags)
        <div>
            <h3 class="text-sm font-medium text-gray-900 border-b border-gray-200 pb-2 mb-2">
                {{-- Format the category name for display, e.g., 'service-style' -> 'Service Style' --}}
                {{ ucwords(str_replace('-', ' ', $category)) }}
            </h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-2">
                @foreach ($tags as $tag)
                    <label for="tag-{{ $tag['id'] }}" class="flex items-center space-x-2">
                        <input id="tag-{{ $tag['id'] }}"
                               name="tags[]"
                               value="{{ $tag['id'] }}"
                               type="checkbox"
                               class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500">
                        <span class="text-sm text-gray-700">{{ $tag['name'] }}</span>
                    </label>
                @endforeach
            </div>
        </div>
    @endforeach
</div>

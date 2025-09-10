<div class="space-y-8">
    @foreach ($tagCategories as $category => $tags)
        <div>
            {{-- Category Title with Emoji --}}
            <h3 class="text-lg font-bold text-d4 border-b border-d5 pb-3 mb-4 flex items-center">
                <span class="mr-3">
                    {{-- Adding relevant emojis based on the category slug --}}
                    @switch($category)
                        @case('service-style')
                            🎨
                            @break
                        @case('sunday-service')
                            🗓️
                            @break
                        @case('language')
                            🗣️
                            @break
                        @case('translation')
                            🌐
                            @break
                        @case('church-size')
                            👥
                            @break
                        @case('fellowship')
                            ☕
                            @break
                        @case('service-offers')
                            👶
                            @break
                        @case('program')
                            🙏
                            @break
                        @case('social-help')
                            ❤️
                            @break
                        @case('accessibility')
                            ♿
                            @break
                        @default
                            ✨
                    @endswitch
                </span>
                {{-- Format the category name for display, e.g., 'service-style' -> 'Service Style' --}}
                {{ ucwords(str_replace('-', ' ', $category)) }}
            </h3>

            {{-- Checkbox Grid --}}
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-x-6 gap-y-4">
                @foreach ($tags as $tag)
                    <label for="tag-{{ $tag['id'] }}" class="flex items-center space-x-3 group cursor-pointer">
                        <input id="tag-{{ $tag['id'] }}"
                               name="tags[]"
                               value="{{ $tag['id'] }}"
                               type="checkbox"
                               {{-- Checkboxes are now rounded-full with a primary-colored tick --}}
                               class="rounded-full border-d5 bg-d3 text-c1 shadow-sm focus:ring-c1 focus:ring-offset-d3 transition">
                        <span class="text-base text-d4 group-hover:text-c1 transition">
                            {{-- This line now displays the emoji from the database for each tag --}}
                            <span class="mr-2">{{ $tag['emoji'] }}</span>{{ $tag['name'] }}
                        </span>
                    </label>
                @endforeach
            </div>
        </div>
    @endforeach
</div>


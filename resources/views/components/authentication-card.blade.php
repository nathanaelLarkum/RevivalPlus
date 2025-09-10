{{-- MODIFICATION: Removed background, shadow, and border classes --}}
<div class="w-full sm:max-w-xl mt-6 px-6 py-4 overflow-hidden sm:rounded-lg">
    <div>
        {{ $logo }}
    </div>

    <div class="w-full mt-6">
        {{ $slot }}
    </div>
</div>

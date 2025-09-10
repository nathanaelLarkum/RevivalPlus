@props(['value'])

<label {{ $attributes->merge(['class' => 'block font-medium text-sm text-c4 dark:text-d4']) }}>
    {{ $value ?? $slot }}
</label>

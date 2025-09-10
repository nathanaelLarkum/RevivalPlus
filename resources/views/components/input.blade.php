@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-d5 bg-d3 text-d4 focus:border-c1 focus:ring-c1 rounded-full shadow-sm']) !!}>

@props(['active'])

@php
    $classes = $active ?? false ? 'sidebar-nav-active' : 'sidebar-nav';
@endphp

<x-splade-link {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</x-splade-link>

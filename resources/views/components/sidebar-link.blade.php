@props(['active'])

@php
    $classes = $active ?? false ? 'sidebar-nav-active' : 'sidebar-nav';
@endphp

<x-splade-link {{ $attributes->merge(['class' => $classes]) }}>
    <x-lucide-chevron-right class="w-4 h-4 mr-2" />
    {{ $slot }}
</x-splade-link>

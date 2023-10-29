@props(['active'])

@php
    $classes = $active ?? false ? 'has-sub sidebar-nav-active' : 'has-sub sidebar-nav';
@endphp

<a href="#" onclick="window.openSubNav(this)" {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>

@props(['active'])

@php
    $classes = $active ?? false ? 'text-green-500' : 'text-red-500';
@endphp

<span {{ $attributes->merge(['class' => $classes]) }}>
    {{ $active ?? false ? 'Active' : 'Inactive' }}
</span>

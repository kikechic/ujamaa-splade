@props(['href'])

<a href="{!! $href !!}" {{ $attributes->class(['print-button flex flex-row']) }} target="_blank">
    @if ($slot->isNotEmpty())
        {{ $slot }}
    @else
        {{ __('Print') }}
    @endif
</a>

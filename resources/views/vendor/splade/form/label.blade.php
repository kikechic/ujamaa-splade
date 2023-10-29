<span class="block mb-1 font-sans text-xs text-gray-700">
    {!! $label !!}
    @if ($attributes->has('required') || $attributes->has('data-required'))
        <span aria-hidden="true" class="text-red-600" title="{{ __('This field is required') }}">*</span>
    @endif
</span>

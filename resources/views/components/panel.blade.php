@php
    $maxWidth = $attributes->get('max-width') || $attributes->get('maxWidth');
    $maxWidthSet = ($attributes->has('max-width') || $attributes->has('maxWidth')) && in_array($maxWidth, ['sm', 'md', 'lg', 'xl', '2xl', '3xl', '4xl', '5xl', '6xl', '7xl']);
@endphp

<div
    {{ $attributes->class([
        'py-2',
        'sm:max-w-sm' => $maxWidth == 'sm',
        'sm:max-w-md' => $maxWidth == 'md',
        'sm:max-w-md md:max-w-lg' => $maxWidth == 'lg',
        'sm:max-w-md md:max-w-xl' => $maxWidth == 'xl',
        'sm:max-w-md md:max-w-xl lg:max-w-2xl' => $maxWidth == '2xl',
        'sm:max-w-md md:max-w-xl lg:max-w-3xl' => $maxWidth == '3xl',
        'sm:max-w-md md:max-w-xl lg:max-w-3xl xl:max-w-4xl' => $maxWidth == '4xl',
        'sm:max-w-md md:max-w-xl lg:max-w-3xl xl:max-w-5xl' => $maxWidth == '5xl',
        'sm:max-w-md md:max-w-xl lg:max-w-3xl xl:max-w-5xl 2xl:max-w-6xl' => $maxWidth == '6xl',
        'sm:max-w-md md:max-w-xl lg:max-w-3xl xl:max-w-5xl 2xl:max-w-7xl' => $maxWidth == '7xl',
        'w-full' => !$maxWidthSet,
        'mx-auto' => $maxWidthSet,
    ]) }}>
    <div class="mx-auto w-full sm:px-2 lg:px-3">
        {{-- <div class="overflow-hidden bg-white shadow-xl sm:rounded-lg"> --}}
        <div class="bg-white shadow-xl sm:rounded-lg">
            <div class="flex flex-row justify-between px-3 pb-2 pt-4 sm:px-6">
                <div class="w-fit whitespace-nowrap pr-5">
                    <h6 class="text-base font-semibold uppercase text-gray-700">
                        {{ $header ?? '' }}
                    </h6>
                </div>
                <div class="inline-flex w-full grow flex-row justify-end space-x-0.5">
                    {{ $actions ?? '' }}
                </div>
            </div>
            <div
                {{ $attributes->class(['px-4 pt-2 pb-4 sm:px-6 bg-white border-b border-gray-200 rounded-lg' => true]) }}>
                {{ $slot }}
            </div>
        </div>
    </div>
</div>

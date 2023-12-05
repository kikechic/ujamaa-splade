@props(['required'])

@php
	$classes = $required ?? false ? 'bg-white pr-1 required' : 'bg-white pr-1';
@endphp

<div class="flex mb-5 space-x-1 text-gray-700">
	<div
		class="inline-flex flex-row w-2/5 mt-2 mb-1 space-x-1 h-fit overflow-ellipsis whitespace-nowrap md:mb-0"
	>
		<label {{ $attributes->merge(['class' => $classes]) }}>
			{{ $label }}
		</label>
		<div class="h-[1px] grow bg-dot bg-center bg-repeat-x py-2"></div>
	</div>
	<div class="flex-grow w-3/5">
		{{ $slot }}
	</div>
</div>

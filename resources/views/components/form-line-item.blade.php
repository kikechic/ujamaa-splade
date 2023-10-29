@props(['required'])

@php
	$classes = $required ?? false ? 'bg-white pr-1 required' : 'bg-white pr-1';
@endphp

<div class="mb-5 table-cell space-x-1 text-gray-700 md:flex">
	<div
		class="mb-1 mt-2 inline-flex h-fit flex-row space-x-1 overflow-ellipsis whitespace-nowrap md:mb-0 md:w-2/5"
	>
		<label {{ $attributes->merge(['class' => $classes]) }}>
			{{ $label }}
		</label>
		<div class="h-[1px] grow bg-dot bg-center bg-repeat-x py-2"></div>
	</div>
	<div class="md:w-3/5 md:flex-grow">
		{{ $slot }}
	</div>
</div>

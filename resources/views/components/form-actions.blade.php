@props(['id'])

@php
	$id = isset($id) ? $id : '';
@endphp

<div
	class="flex flex-row justify-end space-x-1 rounded-b-lg bg-gray-50/80 px-0 py-0 text-right"
	id="{{ $id }}"
>
	{{ $slot }}
</div>

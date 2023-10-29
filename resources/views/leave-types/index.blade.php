@seoTitle(__('Leave Types'))
<x-app-layout>
	<x-panel>
		<x-slot:header>
			{{ __('Leave Types') }}
		</x-slot:header>
		<x-slot:actions>
			@can('leave_types_create')
				<x-splade-button
					type="link"
					modal
					:href="route('leaveTypes.create')"
					:label="__('Create')"
				/>
			@endcan
		</x-slot:actions>
		<x-splade-table
			:for="$leaveTypes"
			search-debounce="500"
		>
			<x-splade-cell name>
				<x-splade-link
					class="text-blue-600 hover:underline"
					modal
					:href="route('leaveTypes.show', $item)"
				>
					{{ $item->name }}
				</x-splade-link>
			</x-splade-cell>
			<x-splade-cell status>
				<x-status :active="$item->status" />
			</x-splade-cell>
			<x-splade-cell actions></x-splade-cell>
		</x-splade-table>
	</x-panel>
</x-app-layout>

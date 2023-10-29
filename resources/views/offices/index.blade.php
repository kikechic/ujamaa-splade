@seoTitle(__('Offices'))
<x-app-layout>
	<x-panel>
		<x-slot:header>
			{{ __('Offices') }}
		</x-slot:header>
		<x-slot:actions>
			@can('offices_create')
				<x-splade-button
					type="link"
					modal
					:href="route('offices.create')"
					:label="__('Create')"
				/>
			@endcan
		</x-slot:actions>
		<x-splade-table
			:for="$offices"
			search-debounce="500"
		>
			<x-splade-cell name>
				<x-splade-link
					class="text-blue-600 hover:underline"
					modal
					:href="route('offices.show', $item)"
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

@seoTitle(__('Departments'))
<x-app-layout>
	<x-panel>
		<x-slot:header>
			{{ __('Departments') }}
		</x-slot:header>
		<x-slot:actions>
			@can('departments_create')
				<x-splade-button
					type="link"
					modal
					:href="route('departments.create')"
					:label="__('Create')"
				/>
			@endcan
		</x-slot:actions>
		<x-splade-table
			:for="$departments"
			search-debounce="500"
		>
			<x-splade-cell name>
				<x-splade-link
					class="text-blue-600 hover:underline"
					modal
					:href="route('departments.show', $item)"
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

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
			<x-splade-cell code>
				<x-splade-link
					class="text-blue-600 hover:underline"
					modal
					:href="route('departments.show', $item)"
				>
					{{ $item->code }}
				</x-splade-link>
			</x-splade-cell>
			<x-splade-cell status>
				<x-status :active="$item->status" />
			</x-splade-cell>
			<x-splade-cell actions>
				@can('departments_update')
					<x-splade-link
						class="mr-2 text-blue-600 hover:underline"
						:href="route('departments.edit', $item)"
						modal
					>
						{{ __('Edit') }}
					</x-splade-link>
				@endcan
				@can('departments_delete')
					<x-splade-link
						class="text-red-600 hover:underline"
						method="DELETE"
						confirm
						:href="route('departments.destroy', $item)"
					>
						{{ __('Delete') }}
					</x-splade-link>
				@endcan
			</x-splade-cell>
		</x-splade-table>
	</x-panel>
</x-app-layout>

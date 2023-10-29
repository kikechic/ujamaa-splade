@seoTitle(__('Donors'))
<x-app-layout>
	<x-panel>
		<x-slot:header>
			{{ __('Donors') }}
		</x-slot:header>
		<x-slot:actions>
			@can('donors_create')
				<x-splade-button
					type="link"
					modal
					:href="route('donors.create')"
					:label="__('Create')"
				/>
			@endcan
		</x-slot:actions>
		<x-splade-table
			:for="$donors"
			search-debounce="500"
		>
			<x-splade-cell code>
				<x-splade-link
					class="text-blue-600 hover:underline"
					modal
					:href="route('donors.show', $item)"
				>
					{{ $item->code }}
				</x-splade-link>
			</x-splade-cell>
			<x-splade-cell status>
				<x-status :active="$item->status" />
			</x-splade-cell>
			<x-splade-cell actions>
				@can('donors_update')
					<x-splade-link
						class="mr-2 text-blue-600 hover:underline"
						:href="route('donors.edit', $item)"
						modal
					>
						{{ __('Edit') }}
					</x-splade-link>
				@endcan
				@can('donors_delete')
					<x-splade-link
						class="text-red-600 hover:underline"
						method="DELETE"
						confirm
						:href="route('donors.destroy', $item)"
					>
						{{ __('Delete') }}
					</x-splade-link>
				@endcan
			</x-splade-cell>
		</x-splade-table>
	</x-panel>
</x-app-layout>

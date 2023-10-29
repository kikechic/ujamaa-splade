@seoTitle(__('Users'))
<x-app-layout>
	<x-panel>
		<x-slot name="header">
			{{ __('Users') }}
		</x-slot>
		<x-slot:actions>
			<x-splade-button
				type="link"
				href="{{ route('users.create') }}"
				modal
			>
				{{ __('Create') }}
			</x-splade-button>
		</x-slot:actions>
		<x-splade-table
			:for="$users"
			search-debounce="500"
		>
			<x-splade-cell is_supervisor>
				{{ $item->is_supervisor ? 'True' : '' }}
			</x-splade-cell>
			<x-splade-cell name>
				<x-splade-link
					class="text-blue-500 hover:underline"
					:href="route('users.show', $item)"
					modal
				>
					{{ $item->name }}
				</x-splade-link>
			</x-splade-cell>
			<x-splade-cell status>
				<x-splade-rehydrate on="user-updated-{{ $item->id }}">
					<x-status :active="$item->status" />
				</x-splade-rehydrate>
			</x-splade-cell>
			<x-splade-cell signature>
				<img
					src="{{ $item->getFirstMediaUrl('signatures', 'thumb') }}"
					width="60"
					height="50"
				>
			</x-splade-cell>
			<x-splade-cell actions>
				<x-splade-link
					class="mr-2 text-blue-600 hover:underline"
					:href="route('users.edit', $item)"
					modal
				>
					{{ __('Edit') }}
				</x-splade-link>
				<x-splade-link
					class="text-red-500 hover:underline"
					:href="route('users.destroy', $item)"
					confirm
					method="delete"
					confirm-text="This action cannot be reversed!"
					confirm-button="Yes, delete!"
					cancel-button="No, cancel"
				>
					{{ __('Delete') }}
				</x-splade-link>
			</x-splade-cell>
		</x-splade-table>
	</x-panel>
</x-app-layout>

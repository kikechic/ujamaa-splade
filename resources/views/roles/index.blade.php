@seoTitle(__('Roles'))
<x-app-layout>
	<x-panel>
		<x-slot:header>
			{{ __('Roles') }}
		</x-slot:header>
		<x-slot:actions>
			@can('roles_create')
				<x-splade-button
					type="link"
					:href="route('roles.create')"
					modal
					:label="__('Create')"
				/>
			@endcan
		</x-slot:actions>
		<x-splade-table
			:for="$roles"
			search-debounce="500"
		>
			<x-splade-cell name>
				<x-splade-link
					class="text-blue-600 hover:underline"
					modal
					:href="route('roles.show', $item)"
				>
					{{ $item->name }}
				</x-splade-link>
			</x-splade-cell>
			<x-splade-cell permissions_count>
				{{ $item->permissions_count }}
				{{ str()->plural('permission', $item->permissions_count) }}
			</x-splade-cell>
			<x-splade-cell users_count>
				{{ $item->users_count }}
				{{ str()->plural('user', $item->users_count) }}
			</x-splade-cell>
			<x-splade-cell status>
				<x-status :active="$item->status" />
			</x-splade-cell>
			<x-splade-cell actions>
				@can('roles_update')
					<x-splade-link
						class="mr-2 text-blue-500 hover:underline"
						modal
						:href="route('roles.edit', $item)"
					>
						{{ __('Edit') }}
					</x-splade-link>
				@endcan
				@can('roles_delete')
					<x-splade-link
						class="text-red-500 hover:underline"
						method="DELETE"
						confirm
						:href="route('roles.destroy', $item)"
					>
						{{ __('Delete') }}
					</x-splade-link>
				@endcan
			</x-splade-cell>
		</x-splade-table>
	</x-panel>
</x-app-layout>

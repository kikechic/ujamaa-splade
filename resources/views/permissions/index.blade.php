@seoTitle(__('Permissions'))
<x-app-layout>
	<x-panel max-width="7xl">
		<x-slot:header>
			{{ __('Permissions') }}
		</x-slot:header>
		<x-splade-table
			:for="$permissions"
			search-debounce="500"
		>
			<x-splade-cell roles_count>
				{{ $item->roles_count }} {{ str()->plural('role', $item->roles_count) }}
			</x-splade-cell>
			<x-splade-cell users_count>
				{{ $item->users_count }} {{ str()->plural('user', $item->users_count) }}
			</x-splade-cell>
			<x-splade-cell actions></x-splade-cell>
		</x-splade-table>
	</x-panel>
</x-app-layout>

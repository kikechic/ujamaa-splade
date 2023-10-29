@seoTitle(__('Companies'))
<x-app-layout>
	<x-panel>
		<x-slot:header>
			{{ __('Companies') }}
		</x-slot:header>
		<x-slot:actions>
			@can('companies_create')
				<x-splade-button
					type="link"
					modal
					:href="route('companies.create')"
					:label="__('Create')"
				/>
			@endcan
		</x-slot:actions>
		<x-splade-table
			:for="$companies"
			search-debounce="500"
		>
			<x-splade-cell name>
				<x-splade-link
					class="text-blue-600 hover:underline"
					modal
					:href="route('companies.show', $item)"
				>
					{{ $item->name }}
				</x-splade-link>
			</x-splade-cell>
			<x-splade-cell status>
				<x-status :active="$item->status" />
			</x-splade-cell>
			<x-splade-cell actions>
				<x-splade-link
					class="text-blue-500 hover:underline"
					modal
					:href="route('companies.edit', $item)"
				>
					{{ __('Edit') }}
				</x-splade-link>
			</x-splade-cell>
		</x-splade-table>
	</x-panel>
</x-app-layout>

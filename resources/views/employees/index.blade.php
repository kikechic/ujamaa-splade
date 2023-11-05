@seoTitle(__('Employees'))
<x-app-layout>
	<x-panel>
		<x-slot:header>
			{{ __('Employees') }}
		</x-slot:header>
		<x-slot:actions>
			@can('employees_create')
				<x-splade-button
					type="link"
					:href="route('employees.create')"
					modal
					:label="__('Create')"
				/>
			@endcan
		</x-slot:actions>
		<x-splade-table
			:for="$employees"
			search-debounce="500"
		>
			<x-splade-cell employee_number>
				<x-splade-link
					class="text-blue-600 hover:text-primary-500 hover:underline"
					modal
					:href="route('employees.show', $item)"
				>
					{{ $item->employee_number }}
				</x-splade-link>
			</x-splade-cell>
			<x-splade-cell status>
				<x-status :active="$item->status" />
			</x-splade-cell>
			<x-splade-cell actions>
				<x-index-actions-dropdown>
					@can('employees_update')
						<x-splade-link
							class="index-actions text-blue-600"
							modal
							:href="route('employees.edit', $item)"
							v-close-popper="true"
						>
							<x-lucide-edit-3 class="h-4 w-4" />
							{{ __('Update') }}
						</x-splade-link>
					@endcan
					@can('employees_delete')
						<x-splade-link
							class="index-actions text-red-500"
							confirm
							method="delete"
							confirm-text="This action cannot be reversed!"
							confirm-button="Yes, delete!"
							cancel-button="No, cancel"
							:href="route('employees.destroy', $item)"
							v-close-popper="true"
						>
							<x-lucide-x class="h-4 w-4" />
							{{ __('Delete') }}
						</x-splade-link>
					@endcan
				</x-index-actions-dropdown>
			</x-splade-cell>
		</x-splade-table>
	</x-panel>
</x-app-layout>

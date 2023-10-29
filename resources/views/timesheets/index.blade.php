@seoTitle(__('Timesheets'))
<x-app-layout>

	<x-panel>

		<x-slot:header>
			{{ __('Timesheets') }}
		</x-slot:header>

		<x-slot name="actions">
			@can('timesheets_create')
				<x-splade-button
					class="mr-2"
					type="link"
					modal
					:href="route('timesheets.entry')"
					:label="__('Create')"
				/>
			@endcan
			<x-splade-button
				type="link"
				modal
				:href="route('timesheets.reports.missing.entry')"
				:label="__('Missing')"
			/>
		</x-slot>

		<x-splade-table
			:for="$timesheets"
			search-debounce="500"
		>
			<x-splade-cell timesheet_number>
				<x-splade-link
					class="text-blue-500 hover:text-primary-500 hover:underline"
					modal
					:href="route('timesheets.show', $item)"
				>
					{{ $item->timesheet_number }}
				</x-splade-link>
			</x-splade-cell>

			<x-splade-cell employee>
				{{ $item->employee->first_name }}
				{{ $item->employee->middle_name }}
				{{ $item->employee->last_name }}
			</x-splade-cell>

			<x-splade-cell employee.employee_number>
				@if ($item->employee->id)
					<x-splade-link
						class="text-blue-500 hover:text-primary-500 hover:underline"
						modal
						:href="route('employees.show', $item->employee)"
					>
						{{ $item->employee->employee_number }}
					</x-splade-link>
				@endif
			</x-splade-cell>

			<x-splade-cell timesheetPeriod>
				{{ $item->timesheetPeriod->period_month?->name }},
				{{ $item->timesheetPeriod->period_year }}
			</x-splade-cell>

			<x-splade-cell status>
				<x-splade-rehydrate on="timesheet-status-updated-{{ $item->id }}">
					{{ status_name($item->status?->name) }}
				</x-splade-rehydrate>
			</x-splade-cell>

			<x-splade-cell actions>
				<x-index-actions-dropdown>
					<x-splade-rehydrate on="timesheet-status-updated-{{ $item->id }}">
						@can('timesheets_update')
							@unless ($item->isPosted() || $item->isApproved())
								<x-splade-link
									class="index-actions text-blue-600"
									modal
									:href="route('timesheets.edit', $item)"
									v-close-popper="true"
								>
									<x-lucide-edit-3 class="h-4 w-4" />
									{{ __('Update') }}
								</x-splade-link>
							@endunless
						@endcan
						@can('timesheets_delete')
							@unless ($item->isPosted() || $item->isApproved() || $item->isPending())
								<x-splade-link
									class="index-actions text-red-500"
									confirm
									method="delete"
									confirm-text="This action cannot be reversed!"
									confirm-button="Yes, delete!"
									cancel-button="No, cancel"
									:href="route('timesheets.destroy', $item)"
									v-close-popper="true"
								>
									<x-lucide-x class="h-4 w-4" />
									{{ __('Delete') }}
								</x-splade-link>
							@endunless
						@endcan
					</x-splade-rehydrate>
				</x-index-actions-dropdown>
			</x-splade-cell>
		</x-splade-table>
		<x-splade-script>
			$splade.on('print-timesheet', (data) => window.open(data.link, '_blank'));
		</x-splade-script>
	</x-panel>
</x-app-layout>

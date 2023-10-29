@seoTitle(__('Timesheet Periods'))
<x-app-layout>

	<x-panel>

		<x-slot:header>
			{{ __('Timesheet Periods') }}
		</x-slot:header>

		<x-slot:actions>
			@can('timesheet_periods_create')
				<x-splade-button
					type="link"
					modal
					:href="route('timesheetPeriods.create')"
					:label="__('Create')"
				/>
			@endcan
		</x-slot:actions>

		<x-splade-table
			:for="$timesheetPeriods"
			search-debounce="500"
		>

			<x-splade-cell status>
				{{ status_name($item->status?->name) }}
			</x-splade-cell>

			<x-splade-cell actions>
				@can('timesheet_periods_update')
					<x-splade-link
						class="mr-1 font-semibold text-indigo-500"
						href="{{ route('timesheetPeriods.edit', $item) }}"
						modal
					>
						{{ __('Update') }}
					</x-splade-link>
				@endcan
				@can('timesheet_periods_delete')
					<x-splade-link
						class="font-semibold text-red-500"
						href="{{ route('timesheetPeriods.destroy', $item) }}"
						confirm-danger="Are you sure you want to delete {{ $item->month_name }} {{ $item->period_year }}?"
						require-password
						method="delete"
						confirm-text="This action cannot be reversed! {{ nl2br('All timesheets relating to this period will be deleted') }}"
						confirm-button="Yes, delete!"
						cancel-button="No, cancel"
					>
						{{ __('Delete') }}
					</x-splade-link>
				@endcan
			</x-splade-cell>

		</x-splade-table>

	</x-panel>

</x-app-layout>

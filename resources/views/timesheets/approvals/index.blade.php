<x-app-layout>
	<x-panel>
		<x-slot name="header">
			{{ __('Timesheets') }}
		</x-slot>
		<x-slot:actions>
			<x-splade-button type="link" :href="route('timesheets.entry')" modal>
				{{ __('Create') }}
			</x-splade-button>
			<x-splade-button type="link" :href="route('timesheets.reports.missing.entry')" modal>
				{{ __('Missing') }}
			</x-splade-button>
		</x-slot:actions>
		<x-splade-table :for="$timesheets" search-debounce="500">
			<x-splade-cell timesheet_number>
				<Link class="text-blue-500" :href="route('timesheets.show', $item)" modal>
				{{ $item->timesheet_number }}
				</Link>
			</x-splade-cell>
			<x-splade-cell employee>
				{{ $item->employee->first_name }}
				{{ $item->employee->middle_name }}
				{{ $item->employee->last_name }}
			</x-splade-cell>
			<x-splade-cell timesheetPeriod>
				{{ config('fusion.months.short')[$item->timesheetPeriod->period_month] }},
				{{ $item->timesheetPeriod->period_year }}
			</x-splade-cell>
			<x-splade-cell status>
				{{ status_name($item->status) }}
			</x-splade-cell>
			<x-splade-cell actions>
				<x-splade-link class="mr-1 font-semibold text-indigo-500" :href="route('timesheetApprovals.show', $item)" modal>
					Approve / Reject
				</x-splade-link>
			</x-splade-cell>
		</x-splade-table>
	</x-panel>
</x-app-layout>

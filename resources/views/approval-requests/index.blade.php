@seoTitle(__('Requests To Approve'))
<x-app-layout>
	<x-panel>
		<x-slot:header>
			{{ __('Requests To Approve') }}
		</x-slot:header>
		<x-slot name="actions">
			<x-splade-button type="link" modal :href="route('timesheets.reports.missing.approvers.entry')" :label="__('Missing')" />
		</x-slot>
		<x-splade-table :for="$approvalRequests" search-debounce="500">
			<x-splade-cell timesheet_id>
				<x-splade-link class="text-blue-500 hover:underline" modal :href="route('timesheets.approve', $item->timesheet)">
					{{ $item->timesheet->timesheet_number }}
				</x-splade-link>
			</x-splade-cell>
		</x-splade-table>
	</x-panel>
</x-app-layout>
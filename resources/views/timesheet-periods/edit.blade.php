@seoTitle(__('Edit Timesheet Period'))
<x-app-layout>
	<x-splade-modal
		class="!p-0"
		position="top"
		close-explicitly
		max-width="3xl"
	>
		<x-splade-form
			method="PUT"
			:action="route('timesheetPeriods.update', $timesheetPeriod)"
			:default="[
			    'timesheet_period_exists' => 'check',
			    'period_year' => $timesheetPeriod->period_year,
			    'period_month' => $timesheetPeriod->period_month,
			    'status' => $timesheetPeriod->status,
			]"
		>
			<x-dialog-modal>
				<x-slot:title>
					{{ __('Edit Timesheet Period') }}
				</x-slot:title>
				<x-slot:content>
					@include('timesheet-periods.partial')
				</x-slot:content>
				<x-slot:footer>
					<x-splade-submit />
					<x-splade-button
						type="button"
						v-on:click="modal.close"
						:label="__('Close')"
					/>
				</x-slot:footer>
			</x-dialog-modal>
		</x-splade-form>
	</x-splade-modal>
</x-app-layout>

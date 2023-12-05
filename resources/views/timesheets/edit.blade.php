@seoTitle(__('Edit Timesheet'))
<x-app-layout>

	<x-splade-modal
		class="!p-0"
		position="top"
		max-width="full"
		close-explicitly
	>
		<x-splade-data>
			<x-splade-form
				method="PUT"
				:action="route('timesheets.update', $timesheet)"
				:default="[
				    'timesheet_period_id' => $timesheet->timesheetPeriod->id,
				    'timesheet_number' => $timesheet->timesheet_number,
				    'hours' => $hours,
				    'donor_ids' => $donors->pluck('id')->toArray(),
				    'rowDonorTotals' => [],
				    'columnDonorTotals' => [],
				    'columnLeaveTotals' => [],
				    'columnTotals' => [],
				    'rowDonorPercentages' => [],
				    'grandDonorTotal' => 0,
				    'grandTotal' => 0,
				    'submission_date' => $timesheet->submission_date,
				]"
			>
				<x-dialog-modal>
					<x-slot:title>
						{{ __('Update Timesheet') }}
					</x-slot:title>
					<x-slot:content>
						<Timesheet
							v-slot="timesheet"
							:form="form"
							:days="@js($days)"
							:editing="true"
						>
							<div class="form-line-items-container">
								<div class="flex flex-col">
									<x-form-line-item>
										<x-slot name="label">
											{{ __('Submission Date') }}
										</x-slot>
										<x-splade-input
											name="submission_date"
											date
										/>
									</x-form-line-item>
									<x-line-item>
										<x-slot name="label">
											{{ __('Year') }}
										</x-slot>
										{{ $timesheet->timesheetPeriod->period_year }}
									</x-line-item>
									<x-line-item>
										<x-slot name="label">
											{{ __('Month') }}
										</x-slot>
										{{ $timesheet->timesheetPeriod->period_month?->name }}
									</x-line-item>
								</div>
								<div class="flex flex-col">
									<x-line-item>
										<x-slot name="label">
											{{ __('Staff ID') }}
										</x-slot>
										{{ $timesheet->employee->employee_number }}
									</x-line-item>
									<x-line-item>
										<x-slot name="label">
											{{ __('Employee Name') }}
										</x-slot>
										{{ $timesheet->employee->first_name }}
										{{ $timesheet->employee->middle_name }}
										{{ $timesheet->employee->last_name }}
									</x-line-item>
									<x-line-item>
										<x-slot name="label">
											{{ __('Job Title') }}
										</x-slot>
										{{ $timesheet->employee->designation->name }}
									</x-line-item>
								</div>
								<div class="flex flex-col">
									<x-line-item>
										<x-slot name="label">
											{{ __('Timesheet No') }}
										</x-slot>
										{{ $timesheet->timesheet_number }}
									</x-line-item>
									<x-line-item>
										<x-slot name="label">
											{{ __('Department') }}
										</x-slot>
										{{ $timesheet->employee->department->name }}
									</x-line-item>
								</div>
							</div>
							@include('timesheets.partial')
						</Timesheet>
					</x-slot:content>
					<x-slot:footer>
						<x-splade-submit />
						<x-splade-button v-on:click.prevent="modal.close">
							{{ __('Close') }}
						</x-splade-button>
					</x-slot:footer>
				</x-dialog-modal>
			</x-splade-form>
		</x-splade-data>
	</x-splade-modal>
</x-app-layout>

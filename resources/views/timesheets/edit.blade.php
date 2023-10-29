@seoTitle(__('Edit Timesheet'))
<x-app-layout>

	<x-panel>

		<x-slot:header>
			{{ __('Update Timesheet') }}
		</x-slot:header>

		<x-splade-data>

			<x-section-border />

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
				    'columnTotals' => [],
				    'rowDonorPercentages' => [],
				    'grandDonorTotal' => 0,
				    'grandTotal' => 0,
				    'submission_date' => $timesheet->submission_date,
				]"
			>

				<Timesheet
					v-slot="timesheet"
					:form="form"
					:days="@js($days)"
					:editing="true"
				>

					<div class="grid w-full grid-cols-3 gap-4">
						<div>
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
						<div>
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
						<div>
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

					<x-form-actions>
						<x-splade-submit :label="__('Submit')" />
						<x-splade-button
							type="link"
							:href="route('timesheets.index')"
							:label="__('Back')"
						/>
					</x-form-actions>

				</Timesheet>

			</x-splade-form>

		</x-splade-data>

	</x-panel>

</x-app-layout>

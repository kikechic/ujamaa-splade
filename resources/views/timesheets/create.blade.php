@seoTitle(__('Create Timesheet'))
<x-app-layout>
	<x-splade-modal
		class="!p-0"
		position="top"
		max-width="full"
		close-explicitly
	>
		<x-splade-data>
			<x-splade-form
				:action="route('timesheets.store')"
				:default="[
				    'timesheet_exists' => 'check',
				    'timesheet_period_id' => $timesheetPeriod->id,
				    'hours' => $hours,
				    'donor_ids' => $donors->pluck('id')->toArray(),
				    'rowDonorTotals' => [],
				    'columnDonorTotals' => [],
				    'columnTotals' => [],
				    'rowDonorPercentages' => [],
				    'grandDonorTotal' => 0,
				    'grandTotal' => 0,
				]"
			>
				<x-dialog-modal>
					<x-slot:title>
						{{ __('Create Timesheet') }}
					</x-slot:title>
					<x-slot:content>
						<Timesheet
							v-slot="timesheet"
							:form="form"
							:days="@js($days)"
						>
							<div class="form-line-items-container">
								<div class="flex flex-col">
									<x-form-line-item>
										<x-slot:label>
											{{ __('Submission Date') }}
										</x-slot:label>
										<x-splade-input
											name="submission_date"
											date
										/>
									</x-form-line-item>
									<x-line-item>
										<x-slot:label>
											{{ __('Year') }}
										</x-slot:label>
										{{ $timesheetPeriod->period_year }}
									</x-line-item>
									<x-line-item>
										<x-slot:label>
											{{ __('Month') }}
										</x-slot:label>
										{{ $timesheetPeriod->period_month?->name }}
									</x-line-item>
								</div>
								<div class="flex flex-col">
									<x-line-item>
										<x-slot:label>
											{{ __('Staff ID') }}
										</x-slot:label>
										@can('employees_access')
											<x-splade-link
												class="text-blue-500 hover:text-primary-500 hover:underline"
												modal
												:href="route('employees.show', $employee)"
											>
												{{ $employee->employee_number }}
											</x-splade-link>
										@else
											{{ $employee->employee_number }}
										@endcan
									</x-line-item>
									<x-line-item>
										<x-slot:label>
											{{ __('Employee Name') }}
										</x-slot:label>
										{{ $employee->first_name }} {{ $employee->middle_name }}
										{{ $employee->last_name }}
									</x-line-item>
									<x-line-item>
										<x-slot:label>
											{{ __('Job Title') }}
										</x-slot:label>
										@if ($employee->designation->id)
											@can('designations_access')
												<x-splade-link
													class="text-blue-500 hover:text-primary-500 hover:underline"
													modal
													:href="route('designations.show', $employee->designation)"
												>
													{{ $employee->designation->name }}
												</x-splade-link>
											@else
												{{ $employee->designation->name }}
											@endcan
										@endif
									</x-line-item>
								</div>
								<div class="flex flex-col">
									<x-line-item>
										<x-slot:label>
											{{ __('Department') }}
										</x-slot:label>
										@if ($employee->department->id)
											@can('departments_access')
												<x-splade-link
													class="text-blue-500 hover:text-primary-500 hover:underline"
													modal
													:href="route('departments.show', $employee->department)"
												>
													{{ $employee->department->name }}
												</x-splade-link>
											@else
												{{ $employee->department->name }}
											@endcan
										@endif
									</x-line-item>
									<x-splade-errors>
										<template v-if="errors.has('timesheet_exists')">
											<x-line-item>
												<x-slot:label>
													{{ __('Timesheet Check') }}
												</x-slot:label>
												<p
													class="font-semibold text-red-500"
													v-text="errors.first('timesheet_exists')"
												/>
											</x-line-item>
										</template>
									</x-splade-errors>
								</div>
							</div>
							@include('timesheets.partial')
						</Timesheet>
					</x-slot:content>
					<x-slot:footer>
						<x-splade-submit />
						<x-splade-button @click.prevent="modal.close">
							{{ __('Close') }}
						</x-splade-button>
					</x-slot:footer>
				</x-dialog-modal>
			</x-splade-form>
		</x-splade-data>
	</x-splade-modal>
</x-app-layout>

<x-section-border />

<div class="inline-flex w-full justify-between">
	<h6
		class="w-full cursor-pointer text-sm font-semibold text-blue-500"
		@click="toggle('isGeneral')"
	>
		{{ __('General') }}
	</h6>
	<div class="inline-flex w-24 flex-nowrap justify-end">
		<button
			class="border-0 bg-transparent px-2 py-1"
			v-show="!isGeneral"
			@click.prevent="toggle('isGeneral')"
		>
			{{ __('Show more') }}
		</button>
		<button
			class="border-0 bg-transparent px-2 py-1"
			v-show="isGeneral"
			@click.prevent="toggle('isGeneral')"
		>
			{{ __('Show less') }}
		</button>
	</div>
</div>

<x-section-border />

<x-splade-transition
	show="isGeneral"
	enter="transition-opacity duration-75"
	enter-from="opacity-0"
	enter-to="opacity-100"
	leave="transition-opacity duration-150"
	leave-from="opacity-100"
	leave-to="opacity-0"
>

	<div class="flex flex-auto flex-row flex-nowrap">
		<div class="grid w-full grid-cols-3 gap-4">
			<div>
				<x-line-item>
					<x-slot name="label">
						{{ __('Timesheet Number') }}
					</x-slot>
					{{ $timesheet->timesheet_number }}
				</x-line-item>
				<x-line-item>
					<x-slot name="label">
						{{ __('Job ID') }}
					</x-slot>
					{{ $timesheet->employee->employee_number }}
				</x-line-item>
				<x-line-item>
					<x-slot name="label">
						{{ __('Employee Name') }}
					</x-slot>
					{{ $timesheet->employee->full_name }}
				</x-line-item>
			</div>
			<div>
				<x-line-item>
					<x-slot name="label">
						{{ __('Timesheet Period') }}
					</x-slot>
					{{ $timesheet->timesheetPeriod->period_month?->name }}
					{{ $timesheet->timesheetPeriod->period_year }}
				</x-line-item>
				<x-line-item>
					<x-slot name="label">
						{{ __('Status') }}
					</x-slot>
					{{ status_name($timesheet->status?->name) }}
				</x-line-item>
			</div>
			<div>
				@if ($approving ?? false)
					<x-form-line-item>
						<x-slot name="label">
							{{ __('Submission Date') }}
						</x-slot>
						<x-splade-input
							name="submission_date"
							date
						/>
					</x-form-line-item>
				@else
					<x-line-item>
						<x-slot name="label">
							{{ __('Submission Date') }}
						</x-slot>
						{{ fusion_date_format($timesheet->submission_date) }}
					</x-line-item>
				@endif

				<x-line-item>
					<x-slot name="label">
						{{ __('Created at') }}
					</x-slot>
					{{ $timesheet->created_at->format(config('fusion.timestamp_format')) }}
				</x-line-item>
			</div>
		</div>
	</div>

</x-splade-transition>

<x-section-border />

<div class="inline-flex w-full justify-between">
	<h6
		class="w-full cursor-pointer text-sm font-semibold text-blue-500"
		@click="toggle('isTimesheetLines')"
	>
		{{ __('Timesheet Lines') }}
	</h6>
	<div class="inline-flex w-24 flex-nowrap justify-end">
		<button
			class="border-0 bg-transparent px-2 py-1"
			v-show="!isTimesheetLines"
			@click.prevent="toggle('isTimesheetLines')"
		>
			{{ __('Show more') }}
		</button>
		<button
			class="border-0 bg-transparent px-2 py-1"
			v-show="isTimesheetLines"
			@click.prevent="toggle('isTimesheetLines')"
		>
			{{ __('Show less') }}
		</button>
	</div>
</div>

<x-section-border />

<x-splade-transition
	show="isTimesheetLines"
	enter="transition-opacity duration-75"
	enter-from="opacity-0"
	enter-to="opacity-100"
	leave="transition-opacity duration-150"
	leave-from="opacity-100"
	leave-to="opacity-0"
>

	<div class="">
		<table class="table-view table w-full">
			<thead>
				<tr>
					<th>Donor</th>
					@foreach ($days as ['day' => $day, 'date' => $date, 'flag' => $flag])
						<th class="!text-center">
							<div>{{ $day }}</div>
							<div>{{ $date }}</div>
						</th>
					@endforeach
					<th>Hrs</th>
					<th>%</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($timesheet->timesheetEntries as $timesheetEntry)
					<tr>
						<td>{{ $timesheetEntry->donor->name }}</td>
						@foreach ($days as $day)
							<td @class(['text-center', 'bg-red-100/70' => !$day['flag']])>
								@php
									$columnName = 'day_' . $loop->iteration;
								@endphp
								{{ $timesheetEntry->{$columnName} }}
							</td>
						@endforeach
						<td>
							{{ number_format(data_get($totals, "row_donor_totals.{$timesheetEntry->donor->id}"), 2) }}
						</td>
						<td>
							{{ data_get($totals, "row_donor_percentages.{$timesheetEntry->donor->id}") }}%
						</td>
					</tr>
				@endforeach
				<tr>
					<th>{{ __('Grand Total') }}</th>
					@foreach ($days as $dayIdx => $day)
						<th>
							{{ number_format(data_get($totals, "column_donor_totals.{$dayIdx}"), 2) }}
						</th>
					@endforeach
					<th>
						{{ number_format(data_get($totals, 'donor_total'), 2) }}
					</th>
					<th>100%</th>
				</tr>
			</tbody>
		</table>
	</div>
</x-splade-transition>
@if ($approving ?? false)
	<div class="pt-5">
		<x-form-line-item>
			<x-slot:label>
				{{ __('Comment') }}
			</x-slot:label>
			<x-splade-textarea name="comment" />
		</x-form-line-item>
	</div>
@endif

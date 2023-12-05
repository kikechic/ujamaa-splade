<x-section-border />

<div class="inline-flex justify-between w-full">
	<h6
		class="w-full text-sm font-semibold text-blue-500 cursor-pointer"
		@click="toggle('isGeneral')"
	>
		{{ __('General') }}
	</h6>
	<div class="inline-flex justify-end w-24 flex-nowrap">
		<button
			class="px-2 py-1 bg-transparent border-0"
			v-show="!isGeneral"
			@click.prevent="toggle('isGeneral')"
		>
			{{ __('Show more') }}
		</button>
		<button
			class="px-2 py-1 bg-transparent border-0"
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
	<div class="mt-3 form-line-items-container">
		<div class="flex flex-col">
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
				@if ($timesheet->employee->id)
					<x-splade-link
						class="text-blue-500 hover:underline"
						modal
						:href="route('employees.show', $timesheet->employee)"
					>
						{{ $timesheet->employee->employee_number }}
					</x-splade-link>
				@endif
			</x-line-item>
			<x-line-item>
				<x-slot name="label">
					{{ __('Employee Name') }}
				</x-slot>
				{{ $timesheet->employee->full_name }}
			</x-line-item>
		</div>
		<div class="flex flex-col">
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
		<div class="flex flex-col">
			@if ($approving ?? false)
				<x-form-line-item>
					<x-slot name="label">
						{{ __('Approval Date') }}
					</x-slot>
					<x-splade-input
						name="approval_date"
						date
					/>
				</x-form-line-item>
			@endif
			<x-line-item>
				<x-slot name="label">
					{{ __('Submission Date') }}
				</x-slot>
				{{ fusion_date_format($timesheet->submission_date) }}
			</x-line-item>

			<x-line-item>
				<x-slot name="label">
					{{ __('Created at') }}
				</x-slot>
				{{ $timesheet->created_at->format(config('fusion.timestamp_format')) }}
			</x-line-item>
		</div>
	</div>

</x-splade-transition>

<x-section-border />

<div class="inline-flex justify-between w-full">
	<h6
		class="w-full text-sm font-semibold text-blue-500 cursor-pointer"
		@click="toggle('isTimesheetLines')"
	>
		{{ __('Timesheet Lines') }}
	</h6>
	<div class="inline-flex justify-end w-24 flex-nowrap">
		<button
			class="px-2 py-1 bg-transparent border-0"
			v-show="!isTimesheetLines"
			@click.prevent="toggle('isTimesheetLines')"
		>
			{{ __('Show more') }}
		</button>
		<button
			class="px-2 py-1 bg-transparent border-0"
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
	<div class="grid grid-cols-1">
		<div class="flex flex-col overflow-x-auto">
			<table class="table-view table min-w-[1600px]">
				<thead>
					<tr>
						<th>Donor</th>
						@foreach ($days as ['day' => $day, 'date' => $date, 'flag' => $flag])
							<th @class(['!text-center', '!bg-red-100/70' => !$flag])>
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
								<td @class(['text-center', '!bg-red-100/70' => !$day['flag']])>
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
							<th @class(['text-center', '!bg-red-100/70' => !$day['flag']])>
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
	</div>
</x-splade-transition>

<x-section-border />

<div class="inline-flex justify-between w-full">
	<h6
		class="w-full text-sm font-semibold text-blue-500 cursor-pointer"
		@click="toggle('isTimesheetComments')"
	>
		{{ __('Timesheet Comments') }}
	</h6>
	<div class="inline-flex justify-end w-24 flex-nowrap">
		<button
			class="px-2 py-1 bg-transparent border-0"
			v-show="!isTimesheetComments"
			@click.prevent="toggle('isTimesheetComments')"
		>
			{{ __('Show more') }}
		</button>
		<button
			class="px-2 py-1 bg-transparent border-0"
			v-show="isTimesheetComments"
			@click.prevent="toggle('isTimesheetComments')"
		>
			{{ __('Show less') }}
		</button>
	</div>
</div>

<x-section-border />

<x-splade-transition
	show="isTimesheetComments"
	enter="transition-opacity duration-75"
	enter-from="opacity-0"
	enter-to="opacity-100"
	leave="transition-opacity duration-150"
	leave-from="opacity-100"
	leave-to="opacity-0"
>
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
	@forelse ($timesheet->timesheetComments as $timesheetComment)
		<div>
			<h4 class="text-lg text-slate-600">
				{{ $timesheetComment->user->name }}
			</h4>
			<p class="">
				{{ $timesheetComment->comment }}
			</p>
			<p>
				{{ fusion_date_format($timesheetComment->created_at, config('fusion.timestamp_format')) }}
			</p>
		</div>
	@empty
	@endforelse
</x-splade-transition>

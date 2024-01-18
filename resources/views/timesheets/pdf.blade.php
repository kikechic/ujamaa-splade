<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>{{ $timesheet->timesheet_number }}</title>

	<style media="screen">
		html {
			font-family: "Segoe Ui";
			margin-top: 0pt;
			margin-bottom: 0pt;
			margin-right: 25pt;
			margin-left: 25pt;
			font-size: 10px;
		}

		body {
			/** 80px, used logo height **/
			margin-top: 70pt;
			margin-bottom: 25pt;
			margin-left: 0pt;
			margin-right: 0pt;
		}

		header {
			position: fixed;
			top: 10pt;
			left: 0pt;
			right: 0pt;
			height: 35pt;
		}

		footer {
			position: fixed;
			bottom: 0pt;
			left: 25pt;
			right: 25pt;
			height: 25pt;
			vertical-align: top;
			font-weight: 400 !important;
		}

		table {
			width: 100%;
			border-collapse: collapse;
		}

		.table-items td {
			border-top: 1px solid black;
		}

		.table-signatures th,
		.table-signatures td {
			border: 1px solid black;
		}

		.uppercase {
			text-transform: uppercase !important;
		}

		.border-0 {
			border: 0px;
		}

		.border-b {
			border-bottom: 1px solid black;
		}

		.border-b-2 {
			border-bottom: 2px solid black;
		}

		.border-t-2 {
			border-top: 2px solid black;
		}

		.border-l-2 {
			border-left: 2px solid black;
		}

		.border-r-2 {
			border-right: 2px solid black;
		}

		.border-t {
			border-top: 1px solid black;
		}

		.border-r {
			border-right: 1px solid black;
		}

		.border-l {
			border-left: 1px solid black;
		}

		.pl-0 {
			padding-left: 0px;
		}

		.px-1 {
			padding-left: 4px;
			padding-right: 4px;
		}

		.pr-0 {
			padding-right: 0px;
		}

		.px-0 {
			padding-left: 0px;
			padding-right: 0px;
		}

		.py-0 {
			padding-top: 0;
			padding-bottom: 0;
		}

		.text-left {
			text-align: left;
		}

		.text-right {
			text-align: right;
		}

		.text-center {
			text-align: center;
		}

		.align-top {
			vertical-align: top;
		}

		.align-bottom {
			vertical-align: bottom;
		}

		.mt-4 {
			margin-top: 16px;
		}

		.mt-8 {
			margin-top: 32px;
		}

		.pb-3 {
			padding-bottom: 12px;
		}

		.pb-2 {
			padding-bottom: 8px;
		}

		.pt-2 {
			padding-top: 8px;
		}

		.py-2 {
			padding-top: 8px;
			padding-bottom: 8px;
		}

		.py-4 {
			padding-top: 16px;
			padding-bottom: 16px;
		}

		.text-base {
			font-size: 16px;
			line-height: 24px;
		}

		.italic {
			font-style: italic;
		}

		.bg-red-100 {
			background-color: #FEE2E2;
		}

		.bg-blue-100 {
			background-color: skyblue;
		}
	</style>
</head>

<body>
	<header>
		<table class="table">
			<tbody>
				<tr>
					<td class="pl-0 text-left" style="width: 50%">
						@if ($timesheet->company->logo_url)
						<img src="{{ $timesheet->company->logo_url }}" alt="logo" height="{{ $logoSize->height }}" width="{{ $logoSize->width }}">
						@endif
					</td>
					<td class="text-right">
						<h4 class="text-base uppercase">
							<strong>{{ __('Timesheet') }}</strong>
						</h4>
					</td>
				</tr>
			</tbody>
		</table>
	</header>

	<main>
		<table class="table">
			<tbody>
				<tr>
					<td class="pl-0" style="width: 70%">
						<p>
							<strong>{{ __('Staff ID') }}: </strong>
							{{ $timesheet->employee->employee_number }}
						</p>
						<p>
							<strong>{{ __('Staff Name') }}: </strong>
							{{ $timesheet->employee->full_name }}
						</p>
						<p>
							<strong>{{ __('Department') }}: </strong>
							{{ $timesheet->employee->department->name }}
						</p>
					</td>
					<td class="text-right">
						<p>
							<strong>{{ __('Timesheet No') }}: </strong>
							{{ $timesheet->timesheet_number }}
						</p>
						<p>
							<strong>{{ __('Document Date') }}: </strong>
							{{ fusion_date_format($timesheet->created_at) }}
						</p>
						<p>
							<strong>{{ __('Period') }}: </strong>
							{{ $timesheet->timesheetPeriod->period_month?->name }}
							{{ $timesheet->timesheetPeriod->period_year }}
						</p>
						<p>
							<strong>{{ __('Submission Date') }}: </strong>
							{{ fusion_date_format($timesheet->submission_date) }}
						</p>

					</td>
				</tr>
			</tbody>
		</table>

		<table class="table table-items">
			<thead>
				<tr>
					<th class="pl-1 text-left border-t-2 border-b-2 border-l-2 border-r" scope="col">
						{{ __('Donor Name') }}
					</th>
					<th class="pl-1 text-left border-t-2 border-b-2 border-l border-r" scope="col">
						{{ __('Code') }}
					</th>
					@foreach ($days as ['day' => $day, 'date' => $date, 'flag' => $flag])
					<th scope="col" @class([ 'px-0 text-center border-t-2 border-b-2 border-l border-r' , 'bg-red-100'=> !$flag,
						])
						>
						<div>{{ $day }}</div>
						<div>{{ $date }}</div>
					</th>
					@endforeach
					<th class="text-right border-t-2 border-b-2 border-l border-r">
						<div>{{ __('Total') }}</div>
						<div>{{ __('Hrs') }}</div>
					</th>
					<th class="text-right border-t-2 border-b-2 border-l border-r-2">%</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($timesheet->timesheetEntries as $item)
				<tr>
					<td class="text-left border-l-2 border-r">
						{{ $item->donor->name }}
					</td>
					<td class="text-left border-l border-r">
						{{ $item->donor->code }}
					</td>
					@foreach ($days as ['day' => $day, 'flag' => $flag])
					<td @class(['text-center border-l border-r', 'bg-red-100'=> !$flag])>
						@php
						$columnName = 'day_' . $loop->iteration;
						$hrs = $item->{$columnName};
						@endphp
						@if ($hrs > 0 && fusion_float($hrs) > 0)
						{{ number_format(fusion_float($hrs), 1) }}
						@else
						{{ $hrs }}
						@endif
					</td>
					@endforeach
					<td class="text-right border-l border-r">
						{{ number_format(data_get($totals, "row_donor_totals.{$item->donor_id}"), 1) }}
					</td>
					<td class="text-right border-r-2">
						{{ number_format(data_get($totals, "row_donor_percentages.{$item->donor_id}"), 2) }}%
					</td>
				</tr>
				@endforeach

				<tr>
					<th class="text-left border-t-2 border-b-2 border-l-2 border-r" colspan="2">
						{{ __('Grand Total') }}
					</th>
					@foreach ($days as $key => $value)
					<th @class([ 'pr-0 text-center border-t-2 border-b-2 border-l border-r total-amount' , 'bg-red-100'=> !$value['flag'],
						])>
						{{ number_format(data_get($totals, "column_donor_totals.{$key}"), 1) }}
					</th>
					@endforeach
					<th class="text-right border-t-2 border-b-2 border-l border-r">
						{{ number_format(data_get($totals, 'donor_total'), 1) }}
					</th>
					<th class="text-right border-t-2 border-b-2 border-l border-r-2">
						100.00%
					</th>
				</tr>
			</tbody>
		</table>

		<p class="py-4 border-t border-b">
			@forelse ($leaveTypes as $leaveType)
			<span style="margin-right: 10px">
				<span>{{ ++$loop->index }}. </span>
				{{ $leaveType->code }} - {{ $leaveType->name }}
			</span>
			@empty
			@endforelse
		</p>

		<x-printing-time />

		<table class="mt-8 table-signature">
			<tbody>
				<tr>
					<td class="align-bottom" style="width: 30% !important;">
						<table style="width: 100%;">
							<tbody>
								<tr>
									<td class="align-bottom border-b">
										{{ $timesheet->user->name }}
									</td>
									<td class="align-bottom border-b">
										{{ fusion_date_format($timesheet->submission_date) }}
									</td>
									<td class="align-bottom border-b">
										@include('components.signature', [
										'userId' => $timesheet->user_id,
										])
									</td>
								</tr>
								<tr>
									<td class="align-top" style="font-weight: 600;">
										{{ __('Employee') }}
									</td>
									<td class="align-top" style="font-weight: 600;">
										{{ __('Date') }}
									</td>
									<td class="align-top" style="font-weight: 600;">
										{{ __('Signature') }}
									</td>
								</tr>
							</tbody>
						</table>
					</td>
					<td style="width: 30% !important;"></td>
					<td class="align-bottom" style="width: 30% !important;">
						<table>
							<tbody>
								<tr>
									<td class="px-1 text-left align-bottom border-b">
										{{ $timesheet->timesheetApproval->user->name }}
									</td>
									<td class="align-bottom border-b">
										{{ fusion_date_format($timesheet->timesheetApproval->approval_date) }}
									</td>
									<td class="align-bottom border-b">
										@include('components.signature', [
										'userId' => $timesheet->timesheetApproval->user_id,
										])
									</td>
								</tr>
								<tr>
									<td class="align-top" style="font-weight: 600;">
										{{ __('Supervisor') }}
									</td>
									<td class="align-top" style="font-weight: 600;">
										{{ __('Date') }}
									</td>
									<td class="align-top" style="font-weight: 600;">
										{{ __('Signature') }}
									</td>
								</tr>
							</tbody>
						</table>
					</td>
				</tr>
			</tbody>
		</table>

	</main>

	<footer></footer>

</body>

</html>
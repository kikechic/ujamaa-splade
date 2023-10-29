<!DOCTYPE html>
<html lang="en">

	<head>
		<meta charset="UTF-8">
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1.0"
		>
		<meta
			http-equiv="X-UA-Compatible"
			content="ie=edge"
		>
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

			.mt-4 {
				margin-top: 16px;
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
						<td
							class="pl-0 text-left"
							style="width: 50%"
						>
							@if ($timesheet->company->logo_url)
								<img
									src="{{ $timesheet->company->logo_url }}"
									alt="logo"
									height="{{ $logoSize->height }}"
									width="{{ $logoSize->width }}"
								>
							@endif
						</td>
						<td class="text-right">
							<h4 class="text-base uppercase">
								<strong>{{ config('fusion.print.timesheets.name') }}</strong>
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
						<td
							class="pl-0"
							style="width: 70%"
						>
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

			<table class="table-items table">
				<thead>
					<tr>
						<th
							class="border-b-2 border-l-2 border-r border-t-2 pl-1 text-left"
							scope="col"
						>
							{{ __('Donor Name') }}
						</th>
						<th
							class="border-b-2 border-l border-r border-t-2 pl-1 text-left"
							scope="col"
						>
							{{ __('Code') }}
						</th>
						@foreach ($days as ['day' => $day, 'date' => $date, 'flag' => $flag])
							<th
								scope="col"
								@class([
									'px-0 text-center border-t-2 border-b-2 border-l border-r',
									'bg-red-100/70' => !$flag,
								])
							>
								<div>{{ $day }}</div>
								<div>{{ $date }}</div>
							</th>
						@endforeach
						<th class="border-b-2 border-l border-r border-t-2 text-right">
							<div>{{ __('Total') }}</div>
							<div>{{ __('Hrs') }}</div>
						</th>
						<th class="border-b-2 border-l border-r-2 border-t-2 text-right">%</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($timesheet->timesheetEntries as $item)
						<tr>
							<td class="border-l-2 border-r text-left">
								{{ $item->donor->name }}
							</td>
							<td class="border-l border-r text-left">
								{{ $item->donor->code }}
							</td>
							@foreach ($days as ['day' => $day, 'flag' => $flag])
								<td @class(['text-center border-l border-r', 'bg-red-100' => !$flag])>
									@php
										$columnName = 'day_' . $loop->iteration;
										$hrs = $item->{$columnName};
									@endphp
									@if ($hrs > 0 && fusion_float($hrs) > 0)
										{{ number_format($hrs, 1) }}
									@else
										{{ $hrs }}
									@endif
								</td>
							@endforeach
							<td class="border-l border-r text-right">
								{{ number_format(data_get($totals, "row_donor_totals.{$item->donor_id}"), 1) }}
							</td>
							<td class="border-r-2 text-right">
								{{ data_get($totals, "row_donor_percentages.{$item->donor_id}") }}%
							</td>
						</tr>
					@endforeach

					<tr>
						<th
							class="border-b-2 border-l-2 border-r border-t-2 text-left"
							colspan="2"
						>
							{{ __('Grand Total') }}
						</th>
						@foreach ($days as $key => $value)
							<th @class([
								'pr-0 text-center border-t-2 border-b-2 border-l border-r total-amount',
								'bg-red-100/70' => !$value['flag'],
							])>
								{{ number_format(data_get($totals, "column_donor_totals.{$key}"), 1) }}
							</th>
						@endforeach
						<th class="border-b-2 border-l border-r border-t-2 text-right">
							{{ number_format(data_get($totals, 'donor_total'), 1) }}
						</th>
						<th class="border-b-2 border-l border-r-2 border-t-2 text-right">100.00%
						</th>
					</tr>
					<tr>
						<th
							style="color: white"
							colspan="{{ count($days) + 4 }}"
						>HD</th>
					</tr>
				</tbody>
			</table>

			@if ($timesheet->notes)
				<p>
					{{-- {{ trans('timesheets::timesheet.notes') }}: {!! $timesheet->notes !!} --}}
				</p>
			@endif

			<x-printing-time />

			<table class="table-signatures mt-4">
				<tbody>
					<tr>
						<th
							class="px-1 text-left"
							style="width: 15%;"
						></th>
						<th
							class="px-1 text-left"
							style="width: 30%;"
						>
							<p>
								{{ __('Approver Name') }}
							</p>
						</th>
						<th
							class="px-1 text-left"
							style="width: 20%;"
						>
							<p>
								{{ __('Job Title') }}
							</p>
						</th>
						<th
							class="px-1 text-left"
							style="width: 15%;"
						>
							<p>
								{{ __('Approval Date') }}
							</p>
						</th>
						<th
							class="px-1 text-left"
							style="width: 20%;"
						>
							<p>
								{{ __('Signature') }}
							</p>
						</th>
					</tr>
					<tr>
						<td class="px-1 text-left">
							<p>
								{{ __('Created By') }}
							</p>
						</td>
						<td class="px-1 text-left">
							<p>
								{{ $timesheet->user->name }}
							</p>
						</td>
						<td class="px-1 text-left">
							<p>

							</p>
						</td>
						<td class="px-1 text-left">
							<p>
								{{ fusion_date_format($timesheet->created_at) }}
							</p>
						</td>
						<td>
							@include('components.signature', [
								'userId' => $timesheet->user_id,
							])
						</td>
					</tr>
				</tbody>
			</table>

		</main>

		<footer></footer>

	</body>

</html>

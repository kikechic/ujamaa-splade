<x-splade-errors>
	<div class="grid grid-cols-1">
		<div class="flex flex-col overflow-x-auto">
			<table class="table-create table min-w-[1600px]">
				<thead>
					<tr>
						<th>Donor</th>
						@foreach ($days as ['day' => $day, 'date' => $date])
							<th class="!text-center">
								<div>{{ $day }}</div>
								<div>{{ $date }}</div>
							</th>
						@endforeach
						<th>
							{{ __('Total') }}
						</th>
						<th> % </th>
					</tr>
				</thead>
				<tbody>
					@foreach ($donors as $donorIndex => $donor)
						<tr>
							<td class="!p-2">
								{{ $donor->name }}
							</td>
							@foreach ($days as $dayIndex => $day)
								<td @class(['bg-red-100/70' => !$day['flag']])>
									<x-splade-input
										@change="timesheet.updateDonorTotal({{ $donorIndex }}, {{ $dayIndex }})"
										v-model="form.hours[{{ $donorIndex }}][{{ $dayIndex }}]"
									/>
								</td>
							@endforeach
							<td v-html="form.rowDonorTotals[{{ $donorIndex }}]"></td>
							<td v-html="form.rowDonorPercentages[{{ $donorIndex }}]"></td>
						</tr>
					@endforeach
					<tr>
						<th>{{ __('Subtotal') }}</th>
						@foreach ($days as $dayIdx => $day)
							<th
								class="text-center"
								v-html="form.columnDonorTotals[{{ $dayIdx }}]"
							></th>
						@endforeach
						<th
							class="text-center"
							v-html="form.grandDonorTotal"
						></th>
						<th>100%</th>
					</tr>
					<tr>
						<td
							class="h-6"
							colspan="{{ count($days) + 3 }}"
						></td>
					</tr>
					<tr>
						<th>{{ __('Grand Total') }}</th>
						@foreach ($days as $dayIdx => $day)
							<th
								class="text-center"
								v-html="form.columnTotals[{{ $dayIdx }}]"
							></th>
						@endforeach
						<th
							class="text-center"
							v-html="form.grandTotal"
						></th>
						<th>100%</th>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</x-splade-errors>

<x-app-layout>
	<x-splade-modal>
		<x-panel>
			<x-slot name="header">
				{{ __('Missing Timesheets Report') }}
			</x-slot>
			<x-top-actions>

			</x-top-actions>
			<table class="table-index mt-5 table w-full">
				<thead>
					<tr>
						<th>{{ __('No') }}</th>
						<th>{{ __('Job ID') }}</th>
						<th>{{ __('Employee Name') }}</th>
						<th>{{ __('Department') }}</th>
						<th>{{ __('Location') }}</th>
					</tr>
				</thead>
				<tbody>
					@forelse ($employees as $employee)
						<tr>
							<td>{{ $loop->iteration }}</td>
							<td>
								<x-splade-link class="text-blue-500" modal :href="route('employees.show', $employee)">
									{{ $employee->employee_number }}
								</x-splade-link>
							</td>
							<td>
								{{ $employee->full_name }}
							</td>
							<td>
								{{ $employee->department->name }}
							</td>
							<td>
								{{ $employee->designation->name }}
							</td>
						</tr>
					@empty
						<tr>
							<td colspan="5">
								{{ __('There are no missing timesheets.') }}
							</td>
						</tr>
					@endforelse
				</tbody>
			</table>
		</x-panel>
	</x-splade-modal>
</x-app-layout>

<x-app-layout>
	<x-splade-modal
		class="!p-0"
		close-explicitly
		position="top"
		max-width="7xl"
	>
		<x-dialog-modal>
			<x-slot:title>
				{{ __('Missing Timesheets Report') }}
			</x-slot:title>
			<x-slot:content>
				<table class="table-index table w-full">
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
									<x-splade-link
										class="text-blue-500 hover:text-primary-500 hover:underline"
										modal
										:href="route('employees.show', $employee)"
									>
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
			</x-slot:content>
			<x-slot:footer>
				<x-splade-button @click.prevent="modal.close">
					{{ __('Close') }}
				</x-splade-button>
			</x-slot:footer>
		</x-dialog-modal>
	</x-splade-modal>
</x-app-layout>

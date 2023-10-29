@seoTitle(__('Employee'))
<x-app-layout>
	<x-splade-modal
		class="!p-0"
		position="top"
		close-explicitly
		max-width="7xl"
	>
		<x-dialog-modal>
			<x-slot:title>
				{{ __('Employee') }}
			</x-slot:title>
			<x-slot:content>
				<div class="grid grid-cols-2 gap-4">
					<x-line-item>
						<x-slot:label>
							{{ __('First Name') }}
						</x-slot:label>
						{{ $employee->first_name }}
					</x-line-item>
					<x-line-item>
						<x-slot:label>
							{{ __('Middle Name') }}
						</x-slot:label>
						{{ $employee->middle_name }}
					</x-line-item>
					<x-line-item>
						<x-slot:label>
							{{ __('Last Name') }}
						</x-slot:label>
						{{ $employee->last_name }}
					</x-line-item>
					<x-line-item>
						<x-slot:label>
							{{ __('Start Date') }}
						</x-slot:label>
						{{ fusion_date_format($employee->start_date) }}
					</x-line-item>
					<x-line-item>
						<x-slot:label>
							{{ __('End Date') }}
						</x-slot:label>
					</x-line-item>
					<x-line-item>
						<x-slot:label>
							{{ __('Department') }}
						</x-slot:label>
					</x-line-item>
					<x-line-item>
						<x-slot:label>
							{{ __('Designation') }}
						</x-slot:label>
					</x-line-item>
					<x-line-item>
						<x-slot:label>
							{{ __('Status') }}
						</x-slot:label>
						<x-status :active="$employee->status" />
					</x-line-item>
				</div>
			</x-slot:content>
			<x-slot:footer>
				<x-splade-button
					v-on:click="modal.close"
					:label="__('Close')"
				/>
			</x-slot:footer>
		</x-dialog-modal>
	</x-splade-modal>
</x-app-layout>

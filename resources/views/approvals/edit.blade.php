@seoTitle(__('Edit Approval Setup'))
<x-app-layout>
	<x-splade-modal
		class="!p-0"
		close-explicitly
		position="top"
		max-width="3xl"
	>
		<x-splade-form
			method="PUT"
			:action="route('approvals.update', $user)"
			:default="[
			    'name' => $user->name,
			    'approver_id' => $user->approval->approver_id,
			    'employee_id' => $user->approval->employee_id,
			    'substitute_id' => $user->approval->substitute_id,
			]"
		>
			<x-dialog-modal>
				<x-slot:title>
					{{ __('Edit Approval Setup') }}
				</x-slot:title>
				<x-slot:content>
					<x-form-line-item>
						<x-slot:label>
							{{ __('Name') }}
						</x-slot:label>
						<x-splade-input
							name="name"
							readonly
						/>
					</x-form-line-item>
					<x-form-line-item required>
						<x-slot name="label">
							{{ __('Approver') }}
						</x-slot>
						<x-splade-select
							name="approver_id"
							:options="$users"
							choices
						/>
					</x-form-line-item>
					<x-form-line-item>
						<x-slot:label>
							{{ __('Inactive Date') }}
						</x-slot:label>
						<x-splade-input
							name="inactive_date"
							date
						/>
					</x-form-line-item>

					<x-form-line-item>
						<x-slot name="label">
							{{ __('Substitute') }}
						</x-slot>
						<x-splade-select
							name="substitute_id"
							:options="$users"
							choices
						/>
					</x-form-line-item>
					<x-form-line-item>
						<x-slot name="label">{{ __('Employee Account') }}</x-slot>
						<x-splade-select
							name="employee_id"
							:options="$employees"
							choices
						/>
					</x-form-line-item>

				</x-slot:content>
				<x-slot:footer>
					<x-splade-submit />
					<x-splade-button @click.prevent="modal.close">
						{{ __('Close') }}
					</x-splade-button>
				</x-slot:footer>
			</x-dialog-modal>
		</x-splade-form>
	</x-splade-modal>
</x-app-layout>

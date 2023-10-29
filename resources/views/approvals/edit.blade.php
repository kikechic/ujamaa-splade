@seoTitle(__('Edit Approval Setup'))
<x-app-layout>
	<x-splade-modal
		class="!p-0"
		close-explicitly
		position="top"
		max-width="7xl"
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
					<div class="grid w-full grid-cols-2 gap-4">
						<div>
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
								<x-slot name="label">{{ __('Approver') }}</x-slot>
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
						</div>
						<div>
							<x-form-line-item>
								<x-slot name="label">{{ __('Substitute') }}</x-slot>
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
						</div>
					</div>
				</x-slot:content>
				<x-slot:footer>
					<x-splade-submit />
					<x-splade-button
						type="button"
						@click="modal.close"
						:label="__('Close')"
					/>
				</x-slot:footer>
			</x-dialog-modal>
		</x-splade-form>
	</x-splade-modal>
</x-app-layout>

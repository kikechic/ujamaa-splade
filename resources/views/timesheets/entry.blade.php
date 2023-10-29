<x-app-layout>
	<x-splade-modal
		class="!p-0"
		position="top"
		close-explicitly
	>
		<x-splade-form
			method="POST"
			:action="route('timesheets.entry.store')"
			:default="[
			    'timesheet_exists' => 'check',
			    'timesheet_period_id',
			]"
		>
			<x-dialog-modal>
				<x-slot:title>
					{{ __('Create Timesheet') }}
				</x-slot:title>
				<x-slot:content>
					<x-form-line-item required>
						<x-slot:label>
							{{ __('Timesheet Period') }}
						</x-slot:label>
						<x-splade-select
							name="timesheet_period_id"
							v-model="form.timesheet_period_id"
							:options="$timesheetPeriods"
						/>
					</x-form-line-item>
					<x-splade-errors>
						<template v-if="errors.has('timesheet_exists')">
							<x-line-item>
								<x-slot:label>
									{{ __('Timesheet Check') }}
								</x-slot:label>
								<p
									class="font-semibold text-red-500"
									v-text="errors.first('timesheet_exists')"
								/>
							</x-line-item>
						</template>
					</x-splade-errors>
				</x-slot:content>
				<x-slot:footer>
					<x-splade-submit>
						{{ __('Submit') }}
					</x-splade-submit>
					<x-splade-button
						type="button"
						@click="modal.close"
					>
						{{ __('Back') }}
					</x-splade-button>
				</x-slot:footer>
			</x-dialog-modal>
		</x-splade-form>
	</x-splade-modal>
</x-app-layout>

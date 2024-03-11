<x-app-layout>
	<x-splade-modal
		class="!p-0"
		position="top"
		close-explicitly
		max-width="3xl"
	>
		<x-splade-form
			method="GET"
			action="{{ route('timesheets.reports.missing.approvers') }}"
			keep-modal
		>
			<x-dialog-modal>
				<x-slot:title>
					{{ __('Missing Timesheets Report') }}
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

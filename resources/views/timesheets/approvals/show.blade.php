@seoTitle(__('Approve Timesheet'))
<x-app-layout>
	<x-splade-modal
		class="!p-0"
		close-explicitly
		position="top"
		max-width="full"
	>
		<x-splade-toggle :data="[
		    'isGeneral' => true,
		    'isTimesheetLines' => true,
		    'isTimesheetComments' => true,
		]">
			<x-splade-form
				method="POST"
				:action="route('timesheets.approve.store', $timesheet)"
				:default="$timesheet"
				confirm
			>
				<x-dialog-modal>
					<x-slot:title>
						{{ __('Approve Timesheet') }}
					</x-slot:title>
					<x-slot:content>
						@include('timesheets.partials.show', [
							'approving' => true,
						])
					</x-slot:content>
					<x-slot:footer>
						<x-splade-submit
							@click.prevent="form.approve = true; form.reject = false; form.return = false; form.submit()"
							:label="__('Approve')"
						/>
						<x-splade-submit
							danger
							@click.prevent="form.reject = true; form.approve = false; form.return = false; form.submit()"
							:label="__('Reject')"
						/>
						<x-splade-submit
							danger
							@click.prevent="form.return = true; form.reject = false; form.approve = false; form.submit()"
							:label="__('Return')"
						/>
						<x-splade-button @click.prevent="modal.close">
							{{ __('Close') }}
						</x-splade-button>
					</x-slot:footer>
				</x-dialog-modal>
			</x-splade-form>
		</x-splade-toggle>
	</x-splade-modal>
</x-app-layout>

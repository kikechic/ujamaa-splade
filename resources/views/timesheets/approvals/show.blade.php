@seoTitle(__('Approve Timesheet'))
<x-app-layout>
	<x-panel>
		<x-slot:header>
			{{ __('Approve Timesheet') }}
		</x-slot:header>
		<x-splade-toggle :data="[
		    'isGeneral' => true,
		    'isTimesheetLines' => true,
		    'isTimesheetComments' => true,
		]">
			<x-splade-form
				method="POST"
				:action="route('timesheets.approve.store', $timesheet)"
				:default="$timesheet"
			>
				@include('timesheets.partials.show', [
					'approving' => true,
				])
				<x-form-actions>
					<x-splade-submit
						type="button"
						@click="form.approve = true; form.reject = false; form.return = false; form.submit()"
						:label="__('Approve')"
					/>
					<x-splade-submit
						type="button"
						danger
						@click="form.reject = true; form.approve = false; form.return = false; form.submit()"
						:label="__('Reject')"
					/>
					<x-splade-submit
						type="button"
						danger
						@click="form.return = true; form.reject = false; form.approve = false; form.submit()"
						:label="__('Return')"
					/>
				</x-form-actions>
			</x-splade-form>
		</x-splade-toggle>
	</x-panel>
</x-app-layout>

@seoTitle(__('Timesheet'))
<x-app-layout>
	<x-splade-modal class="!p-0" position="top" close-explicitly max-width="full">
		<x-splade-toggle :data="[
		    'isGeneral' => true,
		    'isTimesheetLines' => true,
		    'isTimesheetComments' => true,
		]">
			<x-dialog-modal>
				<x-slot:title>
					{{ __('Timesheet') }}
				</x-slot:title>
				<x-slot:content>
					<x-splade-data :default="['status' => $timesheet->status->value]">
						<x-splade-form id="send-approval" stay preserve-scroll method="post" confirm confirm-text="Send approval request?" action="{{ route('approvalRequests.store', ['timesheet'=> $timesheet]) }}" @success="$splade.emit('timesheet-status-updated-' + {{ $timesheet->id }}); data.status = `{{ \App\Enums\TimesheetStatusEnum::pending() }}`">
						</x-splade-form>

						<x-splade-form id="cancel-approval" preserve-scroll confirm confirm-text="Cancel approval request?" action="{{ route('approvalRequests.reject', ['timesheet'=> $timesheet]) }}" method="PUT" @success="$splade.emit('timesheet-status-updated-' + {{ $timesheet->id }}); data.status = `{{ \App\Enums\TimesheetStatusEnum::open() }}`">
						</x-splade-form>

						<x-splade-form id="approve" preserve-scroll confirm confirm-text="Approve request?" action="{{ route('approvalRequests.approve', ['timesheet'=> $timesheet]) }}" method="PUT" @success="$splade.emit('timesheet-status-updated-' + {{ $timesheet->id }}); data.status = `{{ \App\Enums\TimesheetStatusEnum::approved() }}`">
						</x-splade-form>

						<x-splade-form class="hover:text-primary-500 hover:underline" id="post" stay confirm method="post" confirm-text="This action cannot be reversed!" confirm-button="Yes, post!" cancel-button="No, cancel" action="{{ route('timesheets.post', $timesheet) }}" @success="$splade.emit('timesheet-status-updated-' + {{ $timesheet->id }}); data.status = `{{ \App\Enums\TimesheetStatusEnum::posted() }}`">
						</x-splade-form>

						<x-splade-form class="hover:text-primary-500 hover:underline" id="post-and-print" stay confirm method="post" confirm-text="This action cannot be reversed!" confirm-button="Yes, post!" cancel-button="No, cancel" action="{{ route('timesheets.post.print', $timesheet) }}" @success="$splade.emit('timesheet-status-updated-' + {{ $timesheet->id }}); $splade.emit('print-timesheet', {link: `{{ $printURL }}`}); data.status = `{{ \App\Enums\TimesheetStatusEnum::posted() }}`">
						</x-splade-form>

						<x-section-border />

						<div class="flex flex-row items-center w-full py-1 space-x-3 font-semibold">
							<button class="hover:text-primary-500 hover:underline" form="send-approval" type="submit" v-if="data.status == `{{ \App\Enums\TimesheetStatusEnum::open() }}`">
								{{ __('Send approval request') }}
							</button>

							<button class="hover:text-primary-500 hover:underline" form="cancel-approval" type="submit" v-if="data.status == `{{ \App\Enums\TimesheetStatusEnum::pending() }}`">
								{{ __('Cancel approval request') }}
							</button>

							<button class="hover:text-primary-500 hover:underline" form="approve" type="submit" v-if="data.status == `{{ \App\Enums\TimesheetStatusEnum::pending() }}`">
								{{ __('Approve request') }}
							</button>

							<button class="hover:text-primary-500 hover:underline" form="post" type="submit" v-if="data.status == `{{ \App\Enums\TimesheetStatusEnum::approved() }}`">
								{{ __('Post') }}
							</button>
							<button class="hover:text-primary-500 hover:underline" form="post-and-print" type="submit" v-if="data.status == `{{ \App\Enums\TimesheetStatusEnum::approved() }}`">
								{{ __('Post & Print') }}
							</button>
							<x-print-button class="hover:text-primary-500 hover:underline" :href="route('timesheets.print', $timesheet)" />
						</div>
						@include('timesheets.partials.show')
					</x-splade-data>
				</x-slot:content>
				<x-slot:footer>
					<x-splade-button @click.prevent="modal.close">
						{{ __('Close') }}
					</x-splade-button>
				</x-slot:footer>
			</x-dialog-modal>
		</x-splade-toggle>
	</x-splade-modal>
</x-app-layout>
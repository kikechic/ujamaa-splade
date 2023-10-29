@seoTitle(__('Edit Leave Type'))
<x-app-layout>
	<x-splade-modal
		class="!p-0"
		position="top"
		close-explicitly
		max-width="3xl"
	>
		<x-splade-form
			method="PUT"
			:action="route('leaveTypes.update', $leaveType)"
			:default="$leaveType"
		>
			<x-dialog-modal>
				<x-slot:title>
					{{ __('Edit Leave Type') }}
				</x-slot:title>
				<x-slot:content>
					@include('leave-types.partial')
				</x-slot:content>
				<x-slot:footer>
					<x-splade-submit />
					<x-splade-button
						type="button"
						v-on:click="modal.close"
						:label="__('Close')"
					/>
				</x-slot:footer>
			</x-dialog-modal>
		</x-splade-form>
	</x-splade-modal>
</x-app-layout>
